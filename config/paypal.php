<?php
return array(
    // set your paypal credential
    'client_id' => 'ARLmYj1AIp25HxlajAWn8_DXeeM13HSeLn34NRjl1EFABh-qy6ADiP4maIPRDmMidlAotEm7Nbvb-MVG',
    'secret' => 'EHfOHpVXKvISOxv6HBC2-730I2ZLUlnQcfGw7KoPQvhlP34YnaVGKmX7o5ACk0JyQvarEdyh6QJhzb2v',

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