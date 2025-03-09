function updateWeeks() {
    var month = parseInt(document.getElementById("month").value);
    var year = parseInt(document.getElementById("year").value);
    var daysInMonth = new Date(year, month, 0).getDate();
    var weeksDropdown = document.getElementById("weeks");
    var weeks = [];

    weeksDropdown.innerHTML = "";

    for (var i = 1; i <= daysInMonth; i++) {
        var day = new Date(year, month - 1, i);
        if (day.getDay() === 6) { // Sabato
            var weekStart = i;
            var weekEnd = weekStart + 6 <= daysInMonth ? weekStart + 6 : weekStart + 6 - daysInMonth;
            var endMonth = weekStart + 6 <= daysInMonth ? month : (month % 12) + 1;
            var endYear = weekStart + 6 <= daysInMonth ? year : (month === 12 ? year + 1 : year);

            var startDay = String(weekStart).padStart(2, '0');
            var startMonth = String(month).padStart(2, '0');
            var endDay = String(weekEnd).padStart(2, '0');
            endMonth = String(endMonth).padStart(2, '0');

            var option = document.createElement("option");
            option.value = weekStart + "-" + weekEnd;
            option.text = "Sabato " + startDay + "/" + startMonth + " - Venerdì " + endDay + "/" + endMonth;
            weeksDropdown.appendChild(option);

            weeks.push(option.text);
        }
    }
    updateAdditionalWeeks(weeks);
}

function updateMonths() {
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1; // getMonth() ritorna 0-11
    var selectedYear = parseInt(document.getElementById("year").value);
    var monthDropdown = document.getElementById("month");

    monthDropdown.innerHTML = "";

    for (var i = 1; i <= 12; i++) {
        if (selectedYear === currentYear && i < currentMonth) {
            continue; // Salta i mesi precedenti al mese corrente se l'anno selezionato è l'anno corrente
        }
        var option = document.createElement("option");
        option.value = i;
        option.text = new Date(0, i - 1).toLocaleString('it-IT', { month: 'long' }).toUpperCase();
        monthDropdown.appendChild(option);
    }

    if (selectedYear === currentYear) {
        monthDropdown.value = currentMonth;
    } else {
        monthDropdown.value = 1;
    }

    updateWeeks();
}

function updateAdditionalWeeks(weeks) {
    var numWeeks = parseInt(document.getElementById("numWeeks").value);
    var additionalWeeksDiv = document.getElementById("additionalWeeks");
    additionalWeeksDiv.innerHTML = "";

    for (var i = 1; i < numWeeks; i++) {
        if (weeks.length > i) {
            var newLabel = document.createElement("label");
            newLabel.innerHTML = "Seleziona settimana " + (i + 1) + ":";
            var newSelect = document.createElement("select");
            newSelect.name = "weeks" + (i + 1);
            newSelect.className = "weeks";
            newSelect.disabled = true;

            var option = document.createElement("option");
            option.value = weeks[i];
            option.text = weeks[i];
            newSelect.appendChild(option);

            additionalWeeksDiv.appendChild(newLabel);
            additionalWeeksDiv.appendChild(newSelect);
            additionalWeeksDiv.appendChild(document.createElement("br"));
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Pre-seleziona l'anno e il mese correnti
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1; // getMonth() ritorna 0-11
    document.getElementById("year").value = currentYear;
    updateMonths();

    document.getElementById("weeks").addEventListener("change", function() {
        var weeksDropdown = document.getElementById("weeks");
        var weeks = [];
        for (var i = 0; i < weeksDropdown.options.length; i++) {
            weeks.push(weeksDropdown.options[i].text);
        }
        updateAdditionalWeeks(weeks);
    });

    document.getElementById("numWeeks").addEventListener("change", function() {
        var weeksDropdown = document.getElementById("weeks");
        var weeks = [];
        for (var i = 0; i < weeksDropdown.options.length; i++) {
            weeks.push(weeksDropdown.options[i].text);
        }
        updateAdditionalWeeks(weeks);
    });
});