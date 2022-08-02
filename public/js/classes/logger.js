/* eslint-disable no-unused-vars */
//----------------------------------------------------------------------------
//    logger.js
//
//    Mar 05 2019   Initial (Toulouse ENAC)
//    Mar 06 2019   Add log level to the trace
//    Mar 08 2019   test a call from App.vue
//                  Also check that tracing to a file is only possible if not 
//                  requested from a browser
//    Mar 13 2019   Check LOGMODE and LOGFILE variables works
//                  Modify file output logic
//    Mar 14 2019   use helper for dates
//    Apr 03 2019   Test for error : Cannot read property of undefined
//    Oct 04 2019   Pushed in the MEVN Template project
//    Oct 09 2019   Use the datetime service
//    Oct 11 2019   export default
//    Oct 12 2019   Change import to require for node
//                  export default is also a problem
//    Oct 16 2019   Report log level on 1st call
//    Oct 25 2019   Move logger level definitions into properties
//    Jul 17 2021   Undefined constant DEBUGLEVEL
//    Aug 10 2021   Undefined variables
//    Aug 02 2022   Back to work
//----------------------------------------------------------------------------

import properties from './properties';
import { DateTime } from './datetime';

export class Logger {

    Version = 'Logger:1.52, Aug 02 2022';
    DEBUG = parseInt(properties.DEBUG);
    INFORMATIONAL = parseInt(properties.INFORMATIONAL);
    WARNING = parseInt(properties.WARNING);
    ERROR = parseInt(properties.ERROR);
    FATAL = parseInt(properties.FATAL);
    MAXLOGS = 10;
    LOGGERLEVEL = parseInt(properties.DEFAULTLEVEL);
    traceconsoleflag = true;
    datetime = null;
        
    constructor() {
        this.datetime = new DateTime();
    }
    //----------------------------------------------------------------------------
    // LOCAL FUNCTIONS
    // Get a readable log level
    //----------------------------------------------------------------------------
    levelToString(level = DEBUG) {
        switch (level) {
            case this.DEBUG: return 'DBG';
            case this.INFORMATIONAL: return 'INF';
            case this.WARNING: return 'WRN';
            case this.ERROR: return 'ERR';
            case this.FATAL: return 'FTL';
            default: return 'FTL';
        }
    }
    //----------------------------------------------------------------------------
    // The logger 
    // syncmode set to TRUE if waiting for the I/O to complete
    //----------------------------------------------------------------------------
    log(mess, level, syncmode = false) {
        if (level >= this.LOGGERLEVEL) {
            let logstring = this.datetime.getDateTime()
                    + ' [' + this.levelToString(level) + '] '
                    + ' ' + mess ;
            // Is the module called from a browser or from a standalone script ? 
            let display = console;
            if (typeof window !== 'undefined') {
                display = window.console;
            }
            if (this.traceconsoleflag)
                display.log(logstring);
            return;
        }
    }
    //----------------------------------------------------------------------------
    // PUBLIC FUNCTIONS
    //----------------------------------------------------------------------------
    // Logger infos
    // Returns an object with logger data
    //-----------------------------------------------------
    getLoggerInfo() {
        let loggerinfo = {};
        loggerinfo.version = Version;
        loggerinfo.loglevel = LOGGERLEVEL;

        if (process.env.LOGFILE) {
            loggerinfo.logfiledefiner = 'Shell defined';
        }
        else {
            loggerinfo.logfiledefiner = 'Program defined';
        }
        loggerinfo.logfile = OUTFILE;
        if (this.traceconsoleflag) 
            loggerinfo.tracetoconsole = 'Console log enabled'; 
        else 
            loggerinfo.tracetoconsole = 'Console log disabled';
        if (tracetofileflag)
            loggerinfo.tracetofile = 'File log enabled';
        else
            loggerinfo.tracetofile = 'File log disabled';

        return loggerinfo;
    }
    //----------------------------------------------------------------------------
    // Switch console mode
    //----------------------------------------------------------------------------
    enableconsole() {
        this.traceconsoleflag = true;
    }
    disableconsole() {
        if (tracetofileflag)            // If no trace set to file, do not disable the console
            this.traceconsoleflag = false;
    }
    //-----------------------------------------------------
    //  Set the file trace
    //  If no filename passed, will default to OUTFILE
    //  which itsel depends on either LOGFILE environment 
    //  variable or a default (see code above)
    //-----------------------------------------------------
    tracetofile(filename = OUTFILE) {
        tracetofileflag = true;
        OUTFILE = filename;
    }
    //-----------------------------------------------------
    // For ASync mode
    //-----------------------------------------------------
    debug(mess) {
        this.log(mess, this.DEBUG);
        return;
    }
    info(mess) {
        this.log(mess, this.INFORMATIONAL);
        return;
    }
    warning(mess) {
        this.log(mess, this.WARNING);
        return;
    }
    error(mess) {
        this.log(mess, this.ERROR);
        return;
    }
    fatal(mess) {
        this.log(mess, this.FATAL);
        return;
    }
}