<h1>Übersicht</h1>
<? foreach ($visits as $visit): ?>
<?= $visit['user']->vorname; ?> <?= $visit['user']->nachname; ?> <?= $visit['user']->username; ?> <?= date('d.m.Y',$visit['date']); ?> <?= date('H:i',$visit['date']).' Uhr' ?>
<? endforeach; ?>