$('document').ready(function() {

    var credentials = $('#credentials');
    var group = credentials.attr('data-group');
    if (group === 'doctor')
    {
        var doctorID = credentials.attr('data-id');
        $.ajax('/db/measurements', {
            data: {
                doctorid: doctorID,
            }
        }).success(function(data) {
            var measurements = data.data;
            for (var i = 0; i < measurements.length; i++)
            {
                var measurement = measurements[i];
                renderMeasurementRow(measurement);
            }

        });
    }
});

function renderMeasurementRow(measurement)
{
    var measurementsTable = $('#measurementsTable');
    var row = $('<tr/>');

    var tdDate = $('<td/>');
    tdDate.html(measurement.date);
    row.append(tdDate);

    var tdHour = $('<td/>');
    tdHour.html(measurement.time);
    row.append(tdHour);

    var tdPatient = $('<td/>');
    tdPatient.html(measurement.patient);
    row.append(tdPatient);

    var typeMap = new Object();
    typeMap['weight'] = 'Weight';
    typeMap['blood-pressure'] = 'Blood pressure';
    typeMap['sugar-level'] = 'Sugar level';

    var type = measurement.measurement;
    var tdType = $('<td/>');
    tdType.html(typeMap[type]);
    row.append(tdType);

    var unitsMap = new Object();
    unitsMap['weight'] = 'kg';
    unitsMap['blood-pressure'] = 'mmHg';
    unitsMap['sugar-level'] = 'mmol/L';

    var value = measurement.measurementvalue;
    var tdValue = $('<td/>');
    if(value !== null)
        tdValue.html(value + " " + unitsMap[type]);
    else
         tdValue.html('not set');
    row.append(tdValue);

    setColor(row, type, value);
    measurementsTable.append(row);
}

function setColor(row, type, value)
{
    if(value === null)
        row.addClass('warning');
    else
    {
        var lowerBounds = new Object();
        lowerBounds['weight'] = 50;
        lowerBounds['blood-pressure'] = 100;
        lowerBounds['sugar-level'] = 200;
        
        var upperBounds = new Object();
        upperBounds['weight'] = 150;
        upperBounds['blood-pressure'] = 200;
        upperBounds['sugar-level'] = 300;   
        
        if(value < lowerBounds[type] || value > upperBounds[type])
            row.addClass('error');
    }
}