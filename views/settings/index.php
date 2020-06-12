

<? if($selected_folder): ?>
<p> Der Ordner <b>"<?= $selected_folder->name ?>"</b> wurde ausgewählt.</p>
<? else: ?>
<p> Es wurde noch kein Ordner ausgewählt.</p>
<? endif; ?>


<h3>Versteckten Ordner Auswählen:</h3>
<form action="settings/store_folder">
    <input type="hidden" name="cid" value="<?= $cid?>" />
    <select name="folder_id">
        <? foreach($seminar_folders as $folder): ?>
            <option value="<?=$folder->id ?>"><?= $folder->name?></option>
        <? endforeach ?>
    </select>
    <button type="submit" class="button">Auswahl speichern</button>
<form>