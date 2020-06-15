<? if ($pdf_url): ?>
    <iframe src="<?= $pdf_url?>" width="1000" height="1420"/>
<? else: ?>
    <?= \MessageBox::info('Es wurde für Sie noch keine Klausur hinterlegt'); ?>
<? endif; ?>