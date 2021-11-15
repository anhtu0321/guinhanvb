<template>
	<div>
		<router-view></router-view>
	</div>
</template>

<script>

</script>

<style>
/* cyrillic-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(/guinhanvb/lib/public/font/JTURjIg1_i6t8kCHKm45_cJD3gTD_u50.woff2) format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(/guinhanvb/lib/public/font/JTURjIg1_i6t8kCHKm45_cJD3g3D_u50.woff2) format('woff2');
  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(/guinhanvb/lib/public/font/JTURjIg1_i6t8kCHKm45_cJD3gbD_u50.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(/guinhanvb/lib/public/font/JTURjIg1_i6t8kCHKm45_cJD3gfD_u50.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(/guinhanvb/lib/public/font/JTURjIg1_i6t8kCHKm45_cJD3gnD_g.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
*{
	padding:0;
	margin:0;
	box-sizing: border-box;
}
html {
	font-size: 14px;
  /* font-family: 'Montserrat'; */
  font-family: Arial, Helvetica, sans-serif;
	scroll-behavior: smooth;
	min-height: 768px;
}

a {
	text-decoration: none;
}

.container {
	min-height: 100vh;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
}

img {
	object-fit: cover;
}

p {
	color: black;
	font-size: 1.4 rem;
	margin-top: 5px;
	line-height: 2.5rem;
	font-weight: 300;
	letter-spacing: .05rem;
}

</style>