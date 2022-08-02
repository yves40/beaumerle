//----------------------------------------------------------------------------
//    properties.js
//
//    Oct 11 2019   Initial
//    Oct 12 2019   Add node server port
//    Oct 15 2019   Debug level and ports
//    Oct 16 2019   Getter for loglevel info
//                  mongodb URL set to local host
//    Oct 22 2019   Axios URL prefix
//    Oct 23 2019   Wrong nodeserver URL
//    Oct 24 2019   Centralize mongodb checking delay
//    Oct 25 2019   Define logger levels here.
//    Oct 28 2019   Start using the mongo cams schema.
//    Oct 29 2019   Add a user / password for later use with mongo.
//                  Start work on JWT
//    Nov 03 2019   Axios
//    Nov 05 2019   Shorten the mongo monitoring delay
//                  Parameter for the timer in corestore
//    Nov 13 2019   No trace for mongo
//    Nov 29 2019   Timer to 1sec : Externalize session duration time
//    Dec 03 2019   Variable to define alert delay before killing the session
//    Dec 05 2019   Test session expiration 
//    Dec 08 2019   Reset session expiration time
//    Dec 11 2019   Query on mongolog : lines limit parameter
//    Dec 12 2019   session expiration in debug mode (shorter)
//    Dec 20 2019   session expiration in debug mode (longer)
//    Jan 05 2020   Mongodb bind listen on WIFI address
//                  Seems to be 10 times quicker...
//    Jan 14 2020   WIP on multiple deployment hosts for mongodbserver 
//    Jan 17 2020   session duration
//    Jan 20 2020   asusp4 now accesses mongodb in asusp7
//    Feb 01 2020   Mongodb interval check when connection lost
//    Feb 08 2020   In airport
//    Feb 12 2020   Property for log list max number of lines
//    Feb 25 2020   vboxnode deployment
//    Feb 26 2020   vboxnode deployment, change a few things about CORS and
//                  corsclientorigin. Now managed by corshelper
//    Mar 01 2020   zerasp deployment
//    Mar 04 2020   camsapi test
//    Mar 17 2020   ASUSP7 mongodb url updated
//    Mar 21 2020   nodeservercandidates
//    Mar 22 2020   Add IPs
//    Mar 25 2020   Add symbolic names to nodeservercandidates
//    Apr 04 2020   Change symbolic names for nodeservercandidates
//    Jul 17 2021   Fix typo error 
//    Nov 29 2021   set up mongodb params for RYZEN
//    Aug 02 2022   Back to work
//----------------------------------------------------------------------------
// eslint-disable-next-line no-unused-vars

export default {
    Version : 'properties:1.60, Aug 02 2022 ',
    COREDELAY : 1000,
    webserver : "http://beaumerle.fr",
    // Trace HTTP calls to express
    httptrace : false,
    // Define the logger level
    DEBUG : 0,
    INFORMATIONAL : 1,
    WARNING : 2,
    ERROR : 3,
    FATAL : 4,
    DEFAULTLEVEL: 0
}
