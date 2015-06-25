<?php
	/**
	 * Created by PhpStorm.
	 * User: S3b0
	 * Date: 22/06/15
	 * Time: 1:43 PM
	 */

	namespace S3b0\AppLibrary\User;

	class TranslateBits {

		/**
		 * @param int    $bitValue
		 * @param string $osIconSize
		 * @param string $osIconColor
		 *
		 * @return array
		 */
		public static function getSupportedOperatingSystems($bitValue = 0, $osIconSize = '26x26', $osIconColor = 'Black') {
			$list = [];
			$iconPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath( 'app_library' ) . 'Resources/Public/Images/OS/' . $osIconColor . '/' . $osIconSize;

			if ( $bitValue & 1 ) {
				$list[] = [
					'title' => self::translate('supportedOS.0'), 'publicUrl' => $iconPath . '/AndroidOS.png' /* Android */
				];
			}
			if ( $bitValue & 2 ) {
				$list[] = [
					'title' => self::translate('supportedOS.1'), 'publicUrl' => $iconPath . '/MacOS.png'       /* iOS */
				];
			}
			if ( $bitValue & 4 ) {
				$list[] = [
					'title' => self::translate('supportedOS.2'), 'publicUrl' => $iconPath . '/WindowsM.png'    /* Win Mobile */
				];
			}
			if ( $bitValue & 8 ) {
				$list[] = [
					'title' => self::translate('supportedOS.3'), 'publicUrl' => $iconPath . '/Windows8.png'    /* Windows Phone */
				];
			}
			if ( $bitValue & 16 ) {
				$list[] = [
					'title' => self::translate('supportedOS.4'), 'publicUrl' => $iconPath . '/NucleusIco2.png' /* Nucleus OS */
				];
			}
			if ( $bitValue & 32 ) {
				$list[] = [
					'title' => self::translate('supportedOS.5'), 'publicUrl' => $iconPath . '/Linux.png'       /* Linux */
				];
			}
			if ( $bitValue & 64 ) {
				$list[] = [
					'title' => self::translate('supportedOS.6'), 'publicUrl' => $iconPath . '/Other.png'       /* Other */
				];
			}
			if ( $bitValue & 128 ) {
				$list[] = [
					'title' => self::translate('supportedOS.7'), 'publicUrl' => $iconPath . '/MacOS.png'       /* OSX */
				];
			}
			if ( $bitValue & 256 ) {
				$list[] = [
					'title' => self::translate('supportedOS.8'), 'publicUrl' => $iconPath . '/Chrome.png'      /* Chrome OS */
				];
			}
			if ( $bitValue & 512 ) {
				$list[] = [
					'title' => self::translate('supportedOS.9'), 'publicUrl' => $iconPath . '/Firefox.png'     /* Firefox OS */
				];
			}
			if ( $bitValue & 1024 ) {
				$list[] = [
					'title' => self::translate('supportedOS.10'), 'publicUrl' => $iconPath . '/BeOS.png'       /* BeOS */
				];
			}
			if ( $bitValue & 2048 ) {
				$list[] = [
					'title' => self::translate('supportedOS.11'), 'publicUrl' => $iconPath . '/RedHat.png'     /* RedHat */
				];
			}
			if ( $bitValue & 4096 ) {
				$list[] = [
					'title' => self::translate('supportedOS.12'), 'publicUrl' => $iconPath . '/Suse.png'       /* Suse */
				];
			}
			if ( $bitValue & 8192 ) {
				$list[] = [
					'title' => self::translate('supportedOS.13'), 'publicUrl' => $iconPath . '/Unix.png'       /* Unix */
				];
			}
			if ( $bitValue & 16384 ) {
				$list[] = [
					'title' => self::translate('supportedOS.14'), 'publicUrl' => $iconPath . '/Symbian.png'    /* Symbian */
				];
			}
			if ( $bitValue & 32768 ) {
				$list[] = [
					'title' => self::translate('supportedOS.15'), 'publicUrl' => $iconPath . '/DOS.png'        /* DOS */
				];
			}
			if ( $bitValue & 65536 ) {
				$list[] = [
					'title' => self::translate('supportedOS.16'), 'publicUrl' => $iconPath . '/FreeBsd.png'    /* FreeBSD */
				];
			}
			if ( $bitValue & 131072 ) {
				$list[] = [
					'title' => self::translate('supportedOS.17'), 'publicUrl' => $iconPath . '/Mandriva.png'   /* Mandriva */
				];
			}
			if ( $bitValue & 262144 ) {
				$list[] = [
					'title' => self::translate('supportedOS.18'), 'publicUrl' => $iconPath . '/OS2.png'        /* OS/2 */
				];
			}

			return $list;
		}

		/**
		 * @param string $id
		 *
		 * @return NULL|string
		 */
		private static function translate($id = '') {
			return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($id, 'appLibrary');
		}

	}