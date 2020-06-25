<? if($hasWrongFolder): ?>
    <?= \MessageBox::error(
        'Der ausgewählte Ordner entspricht nicht dem richtigen Ordnertyp. Bitte ändern Sie den Ordnertyp oder wählen Sie einen anderen Ordner aus.',
        ['Es sollten nur Ordner vom Typ "Unsichtbarer Ordner" mit gewählter Option "Zugriff auf Dateien per Link erlauben" verwendet werden']
        ); ?>
<? endif; ?>
<? if (!$seminar_folders): ?>
    <?= \MessageBox::info('Es befinden sich keine geeigneten Ordner in dieser Veranstaltung. 
            Bitte legen Sie einen Ordner vom Typ "Unsichtbarer Ordner" an und wählen Sie die Option "Zugriff auf Dateien per Link erlauben".'); ?>
<? endif; ?>

<form action="<?= $controller->link_for('settings/store_folder') ?>" method="post" class="default">
    <fieldset class="default">
        <legend>
        Einstellungen
        </legend>
        <label>
            Ordner für Klausuren
            <select name="folder_id">
                <? foreach($seminar_folders as $folder): ?>
                    <option value="<?= htmlReady($folder->id) ?>" <? if($folder->id == $selected_folder->id):?> selected <? endif;?>><?= htmlReady($folder->name)?></option>
                <? endforeach ?>
            </select>
        </label>
    </fieldset>
    <footer>
        <?= Studip\Button::createAccept('speichern', 'submit') ?>
    </footer>
</form>
    



