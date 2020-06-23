<? if($hasNoFolder): ?>
    <?= \MessageBox::error('Es wurde kein Dateiordner ausgewählt! Bitte wählen Sie unter "Einstellungen" einen Ordner aus.'); ?>
<? endif; ?>
<? if($hasWrongFolder && !$hasNoFolder): ?>
    <?= \MessageBox::error(
        'Der ausgewählte Ordner entspricht nicht dem richtigen Ordnertyp. Bitte ändern Sie den Ordnertyp oder wählen Sie einen anderen Ordner aus.',
        ['Es sollten nur Ordner vom Typ "Unsichtbarer Ordner" mit gewählter Option "Zugriff auf Dateien per Link erlauben" verwendet werden']
        ); ?>
<? endif; ?>
<? if(!$hasNoFolder && !$hasWrongFolder): ?>
<label class="er-exams-label">Teilnehmende</label><br><select id="er-exams-select-user">
<? foreach ($seminar_users as $seminar_user): ?>
   <option data-found="<?= $seminar_user['file_found']; ?>" data-nachname="<?= htmlReady($seminar_user['user_nachname']); ?>"  data-vorname="<?= htmlReady($seminar_user['user_vorname']); ?>"  value="<?= $seminar_user['pdf_url']; ?>"><?= htmlReady($seminar_user['user_nachname']); ?>, <?= htmlReady($seminar_user['user_vorname']); ?> (<?= $seminar_user['matrikelnummer']; ?>) </option>
<? endforeach; ?>
</select>
<br>
<br>
<label class="er-exams-label er-exams-label-exam">Klausur von <span class="er-exams-current-exam-username"></span></label>
<br>
<div class="messagebox messagebox_error er-exams-file-not-found">
    Für die Matrikelnummer von <span id="er-exam-username"></span> wurde keine Datei gefunden!
</div>
<iframe src="" id="er-exams-viewer"width="1000" height="1420">
<? endif; ?>
