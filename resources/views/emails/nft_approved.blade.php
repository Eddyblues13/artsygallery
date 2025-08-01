<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Artsygalley</title>

	<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap"
		rel="stylesheet" />

	<style>
		.proton-body {
			display: block;
			padding: 0px;
			margin: 0px;
		}

		.proton-wrapper {
			width: 100%;
			display: block;
			overflow: hidden;
			box-sizing: border-box;
			color: #222;
			background: #f2f2fd;
			font-size: 18px;
			font-weight: normal;
			font-family: 'Baloo 2', 'Open Sans', 'Roboto', 'Segoe UI', 'Helvetica Neue', Helvetica, Tahoma, Arial, monospace, sans-serif;
		}

		.proton-table {
			border-collapse: collapse;
			border-spacing: 0;
			border: 0px;
			width: 640px;
			max-width: 90%;
			margin: 100px auto;
			box-shadow: 0px 20px 48px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
			overflow: hidden;
		}

		.proton-table tr {
			background: #ffffff;
		}

		.proton-table td,
		.proton-table th {
			border: 0px;
			border-spacing: 0;
			border-collapse: collapse;
		}

		.proton-table tr td {
			padding: 0px 40px;
			box-sizing: border-box;
		}

		.proton-margin {
			float: left;
			width: 100%;
			overflow: hidden;
			height: 40px;
			padding-bottom: 0px;
			box-sizing: border-box;
		}

		.proton-div {
			float: left;
			width: 100%;
			overflow: hidden;
			box-sizing: border-box;
		}

		.proton-table h1,
		.proton-table h2,
		.proton-table h3,
		.proton-table h4 {
			float: left;
			width: 100%;
			margin: 0px 0px 20px 0px !important;
			padding: 0px;
		}

		.proton-table h1 {
			font-size: 33px;
		}

		.proton-table h2 {
			font-size: 26px;
		}

		.proton-table h3 {
			font-size: 23px;
		}

		.proton-table p {
			float: left;
			width: 100%;
			font-size: 18px;
			margin: 0px 0px 20px 0px !important;
		}

		.proton-table h4 {
			font-size: 20px;
		}

		.proton-table a {
			color: #6d49fc;
			font-weight: bold;
		}

		.proton-table a:hover {
			color: #55cc55;
		}

		.proton-table a:active {
			color: #ff6600;
		}

		.proton-table a:visited {
			color: #ff00ff;
		}

		.proton-table a.proton-link {
			display: inline-block;
			width: auto !important;
			outline: none !important;
			text-decoration: none !important;
		}

		.proton-table img,
		.proton-table a img {
			display: block;
			max-width: 100%;
			margin-bottom: 20px;
			border: 0px;
			border-radius: 10px;
			overflow: hidden;
		}

		.proton-table a.proton-button {
			display: inline-block;
			font-weight: bold;
			font-size: 17px;
			padding: 15px 40px;
			margin: 20px 0px;
			color: #ffffff !important;
			background: #6d49fc !important;
			border-radius: 10px;
			text-decoration: none;
			outline: none;
		}

		.proton-table a.proton-button:hover {
			color: #ffffff !important;
			background: #55cc55 !important;
		}

		.proton-code {
			float: left;
			width: 100%;
			overflow: hidden;
			box-sizing: border-box;
			padding: 15px 40px;
			margin: 20px 0px;
			border: 1px dashed #6d49fcaa;
			background: #6d49fc11;
			color: #6d49fc;
			font-weight: 700;
			font-size: 23px;
		}

		.proton-flex {
			float: left;
			width: 100%;
			text-align: center;
		}

		.proton-divider {
			float: left;
			width: 100%;
			overflow: hidden;
			margin: 20px 0px;
			border-top: 2px solid #f2f2fd;
		}
	</style>

	<style>
		.proton-flex img {
			margin: 10px;
			max-width: 15%;
			width: 40px;
		}
	</style>
</head>

<body class="proton-body">
	<div class="proton-wrapper">
		<table class="proton-table">
			<tbody>
				<tr class="proton-tr">
					<td class="proton-td" colspan="10" style="">
						<div class="proton-margin"></div>
						<center>
							<h1>Dear, {{$user['full_name']}}</h1>
							<img src="images/logo.png" alt="Image" />
						</center>

						<br>
						<p>
							Your NFT has been approved successfully and has been uploaded to the marketplace!.
						</p>
						<br>
						<p>
							Amount: ${{$user['amount']}} USD
						</p>
						<p>
							ETH: {{$user['eth']}} ETH
						</p>
						<br>
						<p>
							Gas Fee: 0 ETH
						</p>
						<br>
						<p>
							NFT Name: {{$user['name']}}
						</p>
						<br>
						<p>
							REF NO : NFT{{$user['ref']}}
						</p>
						<br>
						<p>
							Status: {{$user['status']}}
						</p>
						<br>
						<br />

						<br>

					</td>
				</tr>


				<tr class="proton-tr">
					<td class="proton-td" colspan="10" style="">
						<h3>Warm regards,</h3>
						<p>Artsygalley Inc.</p>
					</td>
				</tr>

				<tr class="proton-tr">
					<td class="proton-td" colspan="10" style="">
						<div class="proton-divider"></div>
						<center>
							<span style="color: #706d6b"> © 2024 Artsygalley</span>
						</center>
						<div class="proton-flex">
							<a href="https://proton.me" class="proton-link">
								<img src="https://img.icons8.com/?size=64&id=LPcVDft9Isqt&format=png" alt="Image" />
							</a>
							<a href="https://proton.me" class="proton-link">
								<img src="https://img.icons8.com/?size=64&id=LPcVDft9Isqt&format=png" alt="Image" />
							</a>
							<a href="https://proton.me" class="proton-link">
								<img src="https://img.icons8.com/?size=64&id=LPcVDft9Isqt&format=png" alt="Image" />
							</a>
							<a href="https://proton.me" class="proton-link">
								<img src="https://img.icons8.com/?size=64&id=LPcVDft9Isqt&format=png" alt="Image" />
							</a>
						</div>
						<div class="proton-margin"></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

</html>