<html>
	<head>
		<meta charset="UTF-8">
		<title>{$title}</title>
	</head>
	<body>
		<p>Отчет за прошедший месяц!</p>
		<table border='2px'>	
			<tr>
				{foreach $header as $val}
					<th>{$val['title'] }</th>
				{/foreach}				
			</tr>
			{foreach $array_output as $key => $val}
				<tr>
					{foreach $val as $v}
						<td>{$v}</td>
					{/foreach}
				</tr>
			{/foreach}
		</table>
	</body>
</html>
