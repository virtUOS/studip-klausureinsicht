<? if($hasNoFolder):?>
    <?= \MessageBox::error('Es wurde kein Dateiordner ausgewählt! Bitte wählen Sie unter "Einstellungen" einen Ordner aus.'); ?>
<? else: ?>
    <? if(!$visits):?>
        <?= \MessageBox::info('Bisher wurden keine Klausuren eingesehen'); ?>
    <? else: ?>
    <table class="sortable-table default">
        <thead>
            <tr>
                <th data-sort="text">Nachname</th>
                <th data-sort="text">Vorname</th>
                <th data-sort="text">Matrikelnummer</th>
                <th data-sort="time">Datum - Uhrzeit</th>
            </tr>
        </thead>
    <? foreach ($visits as $visit): ?>
        <tr>
            <td><?= htmlReady($visit['user']->nachname); ?></td>
            <td><?= htmlReady($visit['user']->vorname); ?></td>
            <td><?= htmlReady($visit['matrikelnummer']); ?></td>
            <td data-sort-value="<?= htmlReady($visit['date'])?>"><?= htmlReady(date('d.m.Y',$visit['date'])); ?> - <?= htmlReady(date('H:i',$visit['date']))?> Uhr</td>
        </tr>
    <? endforeach; ?>
    </table>
    <? endif; ?>
<? endif; ?>
