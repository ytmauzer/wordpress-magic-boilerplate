<?php
/**
 * Created by PhpStorm.
 * User: vovasik
 * Date: 31.03.17
 * Time: 22:41
 */

namespace WordpressMagicBoilerplate\Utils;

trait Assets {

	private $defaults_vars = array(
		'css_patch' => "public/css/",
		'js_patch'  => "public/js/",
		'version'   => "1.0.0",
	);

	public function __get( $name ) {
		if ( $name == 'base_name' ) {
			return $this->basename_helper();
		}
		if ( $name == 'file' ) {
			return $this->plugin_dir();
		}
		if ( array_key_exists( $name, $this->defaults_vars ) ) {
			return $this->defaults_vars[ $name ];
		}

		return null;
	}

	public function basename_helper() {
		$array  = explode( '\\', __NAMESPACE__ );
		$id   = array_shift( $array );
		return $id;
	}

	/**
	 * @return string
	 */
	public function plugin_dir() {
		$string = plugin_basename( __FILE__ );
		$array  = explode( '/', $string );
		$path   = array_shift( $array );

		return WP_PLUGIN_DIR . '/' . $path . '/';
	}

	/**
	 * @param mixed string|bool $val
	 *
	 * @return string
	 */
	public function plugin_url( $val = false ) {
		$string      = plugin_basename( __FILE__ );
		$array       = explode( '/', $string );
		$path        = array_shift( $array );
		$plugins_url = plugin_dir_url( WP_PLUGIN_DIR . '/' . $path . '/' );
		if ( ! $val ) {
			return $plugins_url . $path . "/";
		}

		return $plugins_url . $path . "/" . $val;
	}

	/**
	 * @param string $handle
	 * @param bool $in_footer
	 * @param array $dep
	 * @param bool|string $version
	 * @param bool|string $src
	 *
	 * @return string
	 */
	public function registerJs( $handle, $in_footer = false, $dep = array(), $version = false, $src = false ) {
		$this->basename_helper();
		if ( ! $src ) {
			$src     = $this->plugin_url( "{$this->js_patch}{$this->base_name}-{$handle}.js" );
			$file_id = $this->base_name . "-" . $handle;
		} else {
			$file_id = $handle;
		}
		if ( ! $version ) {
			$version = $this->version;
		}

		add_action( "plugins_loaded", function () use ( $in_footer, $version, $dep, $src, $file_id ) {
			wp_enqueue_script(
				$file_id,
				$src,
				$dep,
				$version,
				$in_footer
			);
		}, 10 );

		return $file_id;
	}

	/**
	 * @param string $handle
	 * @param string $position
	 * @param array $dep
	 * @param bool|string $version
	 * @param bool|string $src
	 *
	 * @return string
	 */
	public function addJs( $handle, $position = "wp_enqueue_scripts", $dep = array(), $version = false, $src = false ) {
		$in_footer = false;
		if ( $position == "footer" || $position == "body" ) {
			$position  = "wp_footer";
			$in_footer = true;
		} elseif ( $position == "head" || $position == "wp_enqueue_script" || $position == "head" ) {
			$position = "wp_head";
		}

		$handle = $this->registerJs( $handle, $position, $dep, $version, $src );
		add_action( $position, function () use ( $in_footer, $handle, $src, $dep, $version ) {
			wp_enqueue_script( $handle, $src, $dep, $version, $in_footer );
		}, 20 );

		return $handle;
	}

	/**
	 * @param string $handle
	 * @param array $dep
	 * @param bool|string $version
	 * @param bool|string $src
	 * @param string|string $media
	 *
	 * @return string
	 */
	public function registerCss( $handle, $dep = array(), $version = false, $src = false, $media = 'all' ) {
		if ( ! $src ) {
			$src     = $this->plugin_url( "{$this->css_patch}{$this->base_name}-{$handle}.css" );
			$file_id = $this->base_name . "-" . $handle;
		} else {
			$file_id = $handle;
		}
		if ( ! $version ) {
			$version = $this->version;
		}
		add_action( "wp_enqueue_scripts", function () use ( $media, $version, $dep, $src, $file_id ) {
			wp_register_style(
				$file_id,
				$src,
				$dep,
				$version,
				$media
			);
		}, 10 );

		return $file_id;
	}

	/**
	 * @param string $handle
	 * @param string $position
	 * @param array $dep
	 * @param bool|string $version
	 * @param bool|string $src
	 * @param string $media
	 *
	 * @return string
	 */
	public function addCss( $handle, $position = "wp_enqueue_scripts", $dep = array(), $version = false, $src = false, $media = 'all' ) {
		if ( $position == "footer" || $position == "body" ) {
			$position = "wp_footer";
		} elseif ( $position == "header" || $position == "wp_enqueue_script" || $position == "head" ) {
			$position = "wp_enqueue_scripts";
		}

		$handle = $this->registerCss( $handle, $dep, $version, $src, $media );
		add_action( $position, function () use ( $media, $handle, $dep, $version, $src ) {
			wp_enqueue_style( $handle );
		}, 20 );

		return $handle;
	}

}