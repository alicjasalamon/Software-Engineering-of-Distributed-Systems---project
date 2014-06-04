var random = function(str) {
    return "test" + Math.random().toString().substr(6) + str;
};


var PerformanceTest = function() {
    

};

PerformanceTest.prototype.testGetDay = function(i, values, patient, date) {
    var start = new Date().getTime();
    $.ajax({ type: "POST", url: "db/day", data: {
        patientid: patient,
        date: date
    }}).success(function() {
        var end = new Date().getTime();
        var time = end - start;
        values.push(time);
        console.log('Get day ' + i + ', time: ' + time + 'ms');
    });
};

PerformanceTest.prototype.runTestGetDay = function(timeout, count, patient, date, callback) {
    var start = new Date().getTime();
    var testGetDayTimes = new Array();
    for (var i = 0; i < count; ++i) {
        this.testGetDay(i, testGetDayTimes, patient, date);
    }
    var end = new Date().getTime();
    var time = end - start;
    console.log('Get day run call time: ' + time + 'ms');
    function waitPatiently() {
        setTimeout(function() {
            if (testGetDayTimes.length !== count) {
                waitPatiently();
            } else {
                var end = new Date().getTime();
                var time = end - start;
                var averageTime = time / count;
                console.log('Get day run ' + count + ' times, total time: ' + time + 'ms, average time: ' + averageTime + 'ms');
                callback();
            }
        }, timeout);
    };
    waitPatiently();
};

PerformanceTest.prototype.testGetMeasurements = function(i, values, doctor) {
    var start = new Date().getTime();
    $.ajax({ type: "POST", url: "db/measurements", data: {
        doctorid: doctor
    }}).success(function() { 
        var end = new Date().getTime();
        var time = end - start;
        values.push(time);
        console.log('Get measurements ' + i + ', time: ' + time + 'ms');
    });
};

PerformanceTest.prototype.runTestGetMeasurements = function(timeout, count, doctor, callback) {
    var start = new Date().getTime();
    var testGetMeasurementsTimes = new Array();
    for (var i = 0; i < count; ++i) {
        this.testGetMeasurements(i, testGetMeasurementsTimes, doctor);
    }
    var end = new Date().getTime();
    var time = end - start;
    console.log('Get measurements run call time: ' + time + 'ms');
    function waitPatiently() {
        setTimeout(function() {
            if (testGetMeasurementsTimes.length !== count) {
                waitPatiently();
            } else {
                var end = new Date().getTime();
                var time = end - start;
                var averageTime = time / count;
                console.log('Get measurements run ' + count + ' times, total time: ' + time + 'ms, average time: ' + averageTime + 'ms');
                callback();
            }
        }, timeout);
    };
    waitPatiently();
};

PerformanceTest.prototype.testAddUser = function(i, values, institution, doctor) {
    var start = new Date().getTime();
    $.ajax({type: "POST", url: "db/user/add", data: {
        "institution": institution,
        "doctor": doctor,
        "login": random("user"),
        "password": "1234",
        "group": "patient",
        "firstname": "Jan",
        "lastname": "Kowalski",
        "email": random("@example.com")
    }}).success(function() {
        var end = new Date().getTime();
        var time = end - start;
        values.push(time);
        console.log('Add user ' + i + ', time: ' + time + 'ms');
    });
};

PerformanceTest.prototype.runTestAddUser = function(timeout, count, institution, doctor, callback) {
    var start = new Date().getTime();
    var testAddUserTimes = new Array();
    for (var i = 0; i < count; ++i) {
        this.testAddUser(i, testAddUserTimes, institution, doctor);
    }
    var end = new Date().getTime();
    var time = end - start;
    console.log('Add user run call time: ' + time + 'ms');
    function waitPatiently() {
        setTimeout(function() {
            if (testAddUserTimes.length !== count) {
                waitPatiently();
            } else {
                var end = new Date().getTime();
                var time = end - start;
                var averageTime = time / count;
                console.log('Add user run ' + count + ' times, total time: ' + time + 'ms, average time: ' + averageTime + 'ms');
                callback();
            }
        }, timeout);
    };
    waitPatiently();
};

PerformanceTest.prototype.run = function() {
    var timeout = 500;
    
    var testAddUserCount = 100;
    var testGetMeasurementsCount = 100;
    var testGetDayCount = 100;
    
    var institutionid = '';
    var doctorid = '';
    var patientid = '';
    var date = '';
    
    this.runTestAddUser(timeout, testAddUserCount, institutionid, doctorid, function() {
        this.runTestGetMeasurements(timeout, testGetMeasurementsCount, doctorid, function() {
            this.runTestGetDay(timeout, testGetDayCount, patientid, date, function() {
                console.log('all tests done');
            });
        });
    });

};
