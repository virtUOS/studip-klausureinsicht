<h1>Klausureinsicht Index</h1>
<? if ($pdf_url): ?>
    <iframe src="<?= $pdf_url?>" width="1000" height="1420"/>
<? else: ?>
    <p>Es ist keine Klausur vorhanden.</p>
<? endif; ?>