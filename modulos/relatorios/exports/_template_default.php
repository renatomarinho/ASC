<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="../../../css/estilo_pdf.css"
	type="text/css" />
<style>
</style>

</head>


<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();

  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);

}
</script>
<body>
<table border="0" cellpadding="3" cellspacing="3">
	<tr>
		<td><img src="../../../imgs/logo.jpg" /></td>
		<td><b>
		<div id="relatorio_titulo"></div>
		</b><br />
		<div id="relatorio_descricao"></div>
		</td>
	</tr>
</table>
<hr noshade size="1px">


<div id="append_result"></div>
</body>
</html>
