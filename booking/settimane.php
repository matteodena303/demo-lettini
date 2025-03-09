<!DOCTYPE html>
<html>
<head>
    <title>Menu a tendina con settimane del mese</title>
</head>
<body>
    <form method="POST" id="mainForm">
        <label for="month">Mese/Anno Prenotazione:</label>
        <select id="month" name="month" onchange="resetNumWeeks(); this.form.submit()">
            <?php
                $currentYear = date('Y');
                $currentMonth = date('n');
                $selectedYear = isset($_POST['year']) ? $_POST['year'] : $currentYear;
                $selectedMonth = isset($_POST['month']) ? $_POST['month'] : $currentMonth;

                for ($i = 1; $i <= 12; $i++) {
                    if ($selectedYear == $currentYear && $i < $currentMonth) {
                        continue;
                    }
                    echo '<option value="' . $i . '"' . ($i == $selectedMonth ? ' selected' : '') . '>' . strtoupper(strftime('%B', mktime(0, 0, 0, $i, 1))) . '</option>';
                }
            ?>
        </select>

        <label for="year"></label>
        <select id="year" name="year" onchange="resetNumWeeks(); this.form.submit()">
            <?php
                echo '<option value="' . $currentYear . '"' . ($currentYear == $selectedYear ? ' selected' : '') . '>' . $currentYear . '</option>';
                echo '<option value="' . ($currentYear + 1) . '"' . (($currentYear + 1) == $selectedYear ? ' selected' : '') . '>' . ($currentYear + 1) . '</option>';
            ?>
        </select>

        <br><br>

        <label for="weeks">Settimana/e Prenotazione:</label>
        <select id="weeks" name="weeks" onchange="this.form.submit()">
            <?php
                function calculateWeeks($year, $month) {
                    $weeks = [];
                    $currentDate = strtotime("$year-$month-01");

                    while (date('n', $currentDate) == $month) {
                        if (date('w', $currentDate) == 6) { // Sabato
                            $weekStart = date('d/m/y', $currentDate);
                            $weekEnd = date('d/m/y', strtotime('+6 days', $currentDate));
                            $weeks[] = "$weekStart - $weekEnd";
                        }
                        $currentDate = strtotime('+1 day', $currentDate);
                    }

                    return $weeks;
                }

                $weeks = calculateWeeks($selectedYear, $selectedMonth);
                $selectedWeek = isset($_POST['weeks']) ? $_POST['weeks'] : (count($weeks) > 0 ? $weeks[0] : '');

                foreach ($weeks as $week) {
                    echo '<option value="' . $week . '"' . ($week == $selectedWeek ? ' selected' : '') . '>' . $week . '</option>';
                }
            ?>
        </select>

        <div id="additionalWeeks">
            <?php
                if (isset($_POST['numWeeks'])) {
                    $numWeeks = intval($_POST['numWeeks']);
                } else {
                    $numWeeks = 1;
                }

                if ($selectedWeek) {
                    $selectedWeekEndText = explode(' - ', $selectedWeek)[1];
                    $selectedWeekEndDateParts = explode('/', $selectedWeekEndText);
                    $selectedWeekEndDate = strtotime($selectedWeekEndDateParts[2] . '-' . $selectedWeekEndDateParts[1] . '-' . $selectedWeekEndDateParts[0]);

                    for ($i = 1; $i < $numWeeks; $i++) {
                        $nextWeekStart = strtotime('+1 day', $selectedWeekEndDate); // Inizia dal giorno dopo la fine della settimana selezionata
                        $nextWeekStart = strtotime('+' . (7 * ($i - 1)) . ' days', $nextWeekStart); // Aggiunge settimane intere (7 giorni) a partire da lì
                        $nextWeekEnd = strtotime('+6 days', $nextWeekStart); // La fine della settimana è 6 giorni dopo

                        $startDay = date('d', $nextWeekStart);
                        $startMonth = date('m', $nextWeekStart);
                        $startYear = date('y', $nextWeekStart);
                        $endDay = date('d', $nextWeekEnd);
                        $endMonth = date('m', $nextWeekEnd);
                        $endYear = date('y', $nextWeekEnd);

                        echo '<label>Settimana ' . ($i + 1) . ':</label>';
                        echo '<select name="weeks' . ($i + 1) . '" class="weeks" disabled>';
                        echo '<option value="' . $startDay . '/' . $startMonth . '/' . $startYear . ' - ' . $endDay . '/' . $endMonth . '/' . $endYear . '">';
                        echo $startDay . '/' . $startMonth . '/' . $startYear . ' - ' . $endDay . '/' . $endMonth . '/' . $endYear;
                        echo '</option>';
                        echo '</select><br>';
                    }
                }
            ?>
        </div>

        <br><br>

        <label for="numWeeks">Numero di settimane:</label>
        <select id="numWeeks" name="numWeeks" onchange="this.form.submit()">
            <option value="1" <?php echo $numWeeks == 1 ? 'selected' : ''; ?>>1</option>
            <option value="2" <?php echo $numWeeks == 2 ? 'selected' : ''; ?>>2</option>
            <option value="3" <?php echo $numWeeks == 3 ? 'selected' : ''; ?>>3</option>
        </select>
    </form>

    <script>
        function resetNumWeeks() {
            document.getElementById('numWeeks').value = 1;
        }
    </script>
</body>
</html>
