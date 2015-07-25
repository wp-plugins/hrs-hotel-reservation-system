<?php

if( !class_exists( 'GAHB_Atithi_Create_Tables' ) ){

	class GAHB_Atithi_Create_Tables {

		public $tb_prefix;

		public $sql;

		

		public function __construct(){

			global $wpdb, $table_prefix;

			if(!isset($wpdb)) {

				require_once( ABSPATH . 'wp-config.php' );

				require_once( ABSPATH . 'wp-includes/wp-db.php' );

			}

			

			$this->tb_prefix = $wpdb->prefix;

			$this->tables();

			$this->create_tables();

		}

		

		public function create_tables(){

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			if( is_array( $this->sql ) && count( $this->sql ) ){

				foreach( $this->sql as $sql ){

					dbDelta($sql);

				}

			}

		}

		

		public function tables(){

			$tb_prefix = $this->tb_prefix;

			

			$this->sql[] = 'CREATE TABLE IF NOT EXISTS `'.$tb_prefix.'gahb_bookings` (

							`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

							`booking_id` int(11) NOT NULL UNIQUE KEY,

							`hotel_id` int(11) NOT NULL,

							`room_type_id` int(11) NOT NULL,

							`arrival_date` date NOT NULL,

							`departure_date` date NOT NULL,

							`payment` double NOT NULL,

							`payment_method` varchar(50) NOT NULL,

							`user_id` int(11) NOT NULL,
							
							`status` int(11) NOT NULL

							) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

			/*

			$this->sql[] = 'CREATE TABLE IF NOT EXISTS `'.$tb_prefix.'country` (

							`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

							  `country` varchar(100) NOT NULL

							) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

			

			$this->sql[] = 'CREATE TABLE IF NOT EXISTS `'.$tb_prefix.'state` (

							`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,

							  `state` varchar(100) NOT NULL

							) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

							*/

		}

	}

}

return new GAHB_Atithi_Create_Tables();