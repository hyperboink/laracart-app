<?php
return array(
    // set your paypal credential
    'client_id' => 'ASWkadAYBIw_AQC1zqvrjEl_ou3V8wzBGCwyORQFkBTUMiisULfkLhhoCtXEZvQDK-X878UAGTiyQ2UD',
    'secret' => 'EEfizZmw8DH-UGQkOQQDLFR6bYnea6PItkx1ByB0n8ISPTxSfoCqNqZqIWTFxVIFOe2IT6RTDvW3eMJU',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);