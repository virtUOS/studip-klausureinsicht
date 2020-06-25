<? if ($pdf_url): ?>
    <?= \Studip\LinkButton::create('Klausur herunterladen', $pdf_url, ['download' => '']); ?>
    <br>
    <iframe src="<?= htmlReady($pdf_url)?>" width="1000" height="1420"/>
<? else: ?>
    <?= \MessageBox::info('Es wurde für Sie noch keine Klausur hinterlegt'); ?>
<? endif; ?>
