//----------------------------------------------------------------------------
//    datetime.js
//
//    Oct 09 2019   Initial
//    Oct 10 2019   Timer for minutes
//    Oct 12 2019   export default is a problem for node
//    Oct 29 2019   Get other functions from helpers
//    Feb 09 2020   date format for browser use jj/mm/aaaa
//    Feb 10 2020   More work 
//    Feb 12 2020   New methods 
//    Aug 10 2021   Undeclared datetime ???? 
//    Aug 02 2022   Back to work
//----------------------------------------------------------------------------
// eslint-disable-next-line no-unused-vars

export class DateTime {

Version = 'datetime:1.14, Aug 02 2022';
months = [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ];

    constructor() {

    }

    //----------------------------------------------------------------------------
    // Full date & time string 
    // syncmode set to TRUE if waiting for the I/O to complete
    //----------------------------------------------------------------------------
    getDateTime() {
        let d = new Date();
        return this.months[d.getMonth()] + '-' + d.getDate() + '-' + d.getFullYear() + ' ' 
                + d.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1") ;
    }
    getDate() {
        let d = new Date();
        return this.months[d.getMonth()] + '-' + d.getDate() + '-' + d.getFullYear() + ' ';
    }

    // Offset is optional and specified in days
    getDateBrowserFormat(offset = 0) {  // For bootstrap / browser date picker format
        let d;
        if(offset === 0) {
            d = new Date(Date.now());
        }
        else {
            d = new Date();
            d.setDate(d.getDate() + offset);
        }
        return d.getFullYear() + '-' +  (d.getMonth() + 1).toString().padStart(2, "0") + '-' + d.getDate().toString().padStart(2, "0");
    }

    getDateBrowserFormatMax(offset = 0) {
        let d;
        if(offset === 0) {
            d = new Date(Date.now());
        }
        else {
            d = new Date();
            d.setDate(d.getDate() + offset);
        }
        d.setHours(23);
        d.setMinutes(59);
        return d.getFullYear() + '-' +  (d.getMonth() + 1).toString().padStart(2, "0") + '-' + d.getDate().toString().padStart(2, "0");
    }

    getDateBrowserFormatMin(offset = 0) {
        let d;
        if(offset === 0) {
            d = new Date(Date.now());
        }
        else {
            d = new Date();
            d.setDate(d.getDate() + offset);
        }
        d.setHours(0);
        d.setMinutes(0);
        return d.getFullYear() + '-' +  (d.getMonth() + 1).toString().padStart(2, "0") + '-' + d.getDate().toString().padStart(2, "0");
    }

    getTime() {
        let d = new Date();
        return d.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1") ;
    }
    getShortTime() {
        return new Date().toTimeString().slice(0,5);
    }

    getHoursMinutes() {
        let d = new Date();
        let time = d.getHours() + ':' + d.getMinutes();
        return time;
    }

    getHoursMinutesSeconds() {
        let d = new Date();
        return d.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
    }

    convertDateTime(thedate) {
        if (thedate) {
            let computedate = new Date(thedate);
            let day = computedate.getDate();
            let days = '';
            let datetime = null;
            if (day < 10) days = day.toString().replace(/.*(^\d{1}).*/, "0$1");
                else days = day.toString();
                    datetime = this.months[computedate.getMonth()] + '-' +  days + '-' 
                    + computedate.getFullYear() + ' ' 
                    + computedate.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1"); 
            return datetime;
        }
        else {
            return "Unset"
        }
    }

    convertSecondsToHMS(seconds) {
        let computedate = new Date(1970,0,1);
        computedate.setSeconds(seconds);
        return computedate.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");    
    }

}

