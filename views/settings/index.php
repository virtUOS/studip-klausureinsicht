

<? if($selected_folder): ?>
<div class="er-settings-seleted er-settings-box">
    <header class="er-settings-header">
        Ausgewählter Ordner
        <button class="er-settings-edit"></button>
    </header>
    <div class="er-settings-seleted-content">
        <span class="er-settings-selected-foldername"><?= $selected_folder->name ?></span>
    </div>
</div>
<div class="er-settings-reselect er-settings-box">
    <header class="er-settings-header">
        Auswahl des versteckten Ordners ändern
        <button class="er-settings-cancel-edit"></button>
    </header>
    <form action="settings/store_folder" class="er-settings-folder">
        <input type="hidden" name="cid" value="<?= $cid?>" />
        <select name="folder_id">
            <? foreach($seminar_folders as $folder): ?>
                <option value="<?=$folder->id ?>"><?= $folder->name?></option>
            <? endforeach ?>
        </select>
        <br>
        <?= Studip\Button::createAccept('Auswahl speichern', 'submit') ?>
        <?= Studip\Button::createCancel('Abbrechen', 'cancel') ?>
    </form>
    
</div>
<? else: ?>
    <? if ($seminar_folders): ?>
        <div class="er-settings-select er-settings-box">
            <header class="er-settings-header">Versteckten Ordner Auswählen</header>
            <form action="settings/store_folder" class="er-settings-folder">
                <input type="hidden" name="cid" value="<?= $cid?>" />
                <select name="folder_id">
                    <? foreach($seminar_folders as $folder): ?>
                        <option value="<?=$folder->id ?>"><?= $folder->name?></option>
                    <? endforeach ?>
                </select>
                <br>
                <?= Studip\Button::createAccept('Auswahl speichern', 'submit') ?>
            <form>
        </div>
    <? else: ?>
        <?= \MessageBox::info('Es befinden sich keine geeigneten Ordner in dieser Veranstaltung. 
                Bitte legen Sie einen Ordner vom Typ "Unsichtbarer Ordner" an und wählen Sie die Option "Zugriff auf Dateien per Link erlauben".'); ?>
    <? endif; ?>
<? endif; ?>


