<? if ($pdf_url): ?>
    <?= \Studip\LinkButton::create('Klausur herunterladen', $pdf_url, ['download' => $pdf_url]); ?>
    <br>
    <iframe src="<?= $pdf_url?>" width="1000" height="1420"/>
<? else: ?>
    <?= \MessageBox::info('Es wurde für Sie noch keine Klausur hinterlegt'); ?>
<? endif; ?>
