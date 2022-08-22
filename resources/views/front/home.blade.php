@extends('layouts.app')

@section('content')
<header id="header" style="padding-top:80px !important;">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 position-relative">
				<div class="header-cover-mobile">
					<h2 class="mb-3">Siapkan Diri Hadapi Tes CPNS<br /> 
					Bersama Kami</h2>
					<p class="mb-5">Jangan sampai persiapanmu yang minim menghalangi impianmu menjadi PNS. Pilih programmnya sekarang dan mulai belajar lebih awal!</p>
					<a href="#">Coba Gratis</a>
				</div>
				<!-- IMAGE DESKTOP -->
				<img class="d-none d-sm-block" src="{{ asset('front/images/website/header.png') }}" alt="#">
				<!-- IMAGE MOBILE -->
				<img class="d-block d-sm-none" src="{{ asset('front/images/website/header-mobile.png') }}" alt="#">
			</div>
		</div>
	</div>
</header>
<!-- MAIN -->
<main id="main">
	<div class="container-cpns">
		<div class="row mb-4 mb-md-5">
			<div class="col-lg-12 text-center">
				<h1 class="text-title">Kenapa Ikut Try Out di Kartu Ujian Dot Com ?</h1>
				<!-- <p class="text-description">Platform Try Out CPNS terbaik di Indonesia</p> -->
			</div>
		</div>
		<div class="row">
			<!-- <article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17 0.333344C14.8113 0.333344 12.644 0.76444 10.6219 1.60202C8.59983 2.4396 6.76251 3.66725 5.21487 5.2149C2.08926 8.3405 0.333313 12.5797 0.333313 17C0.333313 21.4203 2.08926 25.6595 5.21487 28.7851C6.76251 30.3328 8.59983 31.5604 10.6219 32.398C12.644 33.2356 14.8113 33.6667 17 33.6667C21.4203 33.6667 25.6595 31.9107 28.7851 28.7851C31.9107 25.6595 33.6666 21.4203 33.6666 17C33.6666 15.0667 33.3166 13.15 32.65 11.35L29.9833 14.0167C30.2167 15 30.3333 16 30.3333 17C30.3333 20.5362 28.9286 23.9276 26.4281 26.4281C23.9276 28.9286 20.5362 30.3333 17 30.3333C13.4638 30.3333 10.0724 28.9286 7.57189 26.4281C5.0714 23.9276 3.66665 20.5362 3.66665 17C3.66665 13.4638 5.0714 10.0724 7.57189 7.57192C10.0724 5.07143 13.4638 3.66668 17 3.66668C18 3.66668 19 3.78334 19.9833 4.01668L22.6666 1.33334C20.85 0.683343 18.9333 0.333344 17 0.333344ZM28.6666 0.333344L22 7.00001V9.50001L17.75 13.75C17.5 13.6667 17.25 13.6667 17 13.6667C16.1159 13.6667 15.2681 14.0179 14.643 14.643C14.0178 15.2681 13.6666 16.116 13.6666 17C13.6666 17.8841 14.0178 18.7319 14.643 19.357C15.2681 19.9822 16.1159 20.3333 17 20.3333C17.884 20.3333 18.7319 19.9822 19.357 19.357C19.9821 18.7319 20.3333 17.8841 20.3333 17C20.3333 16.75 20.3333 16.5 20.25 16.25L24.5 12H27L33.6666 5.33334H28.6666V0.333344ZM17 7.00001C14.3478 7.00001 11.8043 8.05358 9.92891 9.92894C8.05355 11.8043 6.99998 14.3478 6.99998 17C6.99998 19.6522 8.05355 22.1957 9.92891 24.0711C11.8043 25.9464 14.3478 27 17 27C19.6521 27 22.1957 25.9464 24.0711 24.0711C25.9464 22.1957 27 19.6522 27 17H23.6666C23.6666 18.7681 22.9643 20.4638 21.714 21.7141C20.4638 22.9643 18.7681 23.6667 17 23.6667C15.2319 23.6667 13.5362 22.9643 12.2859 21.7141C11.0357 20.4638 10.3333 18.7681 10.3333 17C10.3333 15.2319 11.0357 13.5362 12.2859 12.286C13.5362 11.0357 15.2319 10.3333 17 10.3333V7.00001Z" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Paket Soal Akurat</h2>
					</div>
				</div>
				<div>
					<p>Soal pilihan yang diantaranya diambil dari soal tes CPNS tahun sebelumnya dan merupakan soal terbaik CPNS Indonesia.</p>
				</div>
			</article> -->
			<article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="38" height="30" viewBox="0 0 38 30" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M34 0H4C3.11595 0 2.2681 0.351189 1.64298 0.976311C1.01786 1.60143 0.666672 2.44928 0.666672 3.33333V8.33333H4V3.33333H34V26.6667H22.3333V30H34C34.8841 30 35.7319 29.6488 36.357 29.0237C36.9821 28.3986 37.3333 27.5507 37.3333 26.6667V3.33333C37.3333 2.44928 36.9821 1.60143 36.357 0.976311C35.7319 0.351189 34.8841 0 34 0ZM0.666672 25V30H5.66667C5.66667 28.6739 5.13989 27.4021 4.20221 26.4645C3.26452 25.5268 1.99275 25 0.666672 25ZM0.666672 18.3333V21.6667C1.76102 21.6667 2.84465 21.8822 3.8557 22.301C4.86675 22.7198 5.78541 23.3336 6.55923 24.1074C7.33305 24.8813 7.94688 25.7999 8.36567 26.811C8.78446 27.822 9 28.9057 9 30H12.3333C12.3333 26.9058 11.1042 23.9383 8.91625 21.7504C6.72833 19.5625 3.76086 18.3333 0.666672 18.3333ZM0.666672 11.6667V15C2.6365 15 4.58704 15.388 6.40692 16.1418C8.22681 16.8956 9.88039 18.0005 11.2733 19.3934C12.6662 20.7863 13.771 22.4399 14.5249 24.2597C15.2787 26.0796 15.6667 28.0302 15.6667 30H19C19 19.8667 10.7833 11.6667 0.666672 11.6667ZM17.3333 13.4833V16.8167L23.1667 20L29 16.8167V13.4833L23.1667 16.6667L17.3333 13.4833ZM23.1667 5L14 10L23.1667 15L32.3333 10L23.1667 5Z" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Pengerjaan Online</h2>
					</div>
				</div>
				<div>
					<p>Kerjakan dimanapun Anda berada, gunakan Handphone atau Komputer untuk merasakan sensasi soal-soal Try Out CPNS Indonesia.</p>
				</div>
			</article>
			<article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.66667 0H3.33333V10H6.66667V0ZM26.6667 0H23.3333V16.6667H26.6667V0ZM0 16.6667H3.33333V30H6.66667V16.6667H10V13.3333H0V16.6667ZM20 6.66667H16.6667V0H13.3333V6.66667H10V10H20V6.66667ZM13.3333 30H16.6667V13.3333H13.3333V30ZM20 20V23.3333H23.3333V30H26.6667V23.3333H30V20H20Z" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Hasil Instan</h2>
					</div>
				</div>
				<div>
					<p>Tak perlu waktu lama untuk mendapatkan hasil Tryout Anda, Hasil langsung keluar ketika pengerjaan selesai.</p>
				</div>
			</article>
			<!-- <article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M25.3333 3.66668V0.333344H8.66665V3.66668H0.333313V15.3333C0.333313 17.1667 1.83331 18.6667 3.66665 18.6667H8.83331C9.16194 20.2673 9.95296 21.7362 11.1083 22.8916C12.2637 24.047 13.7327 24.838 15.3333 25.1667V28.8C10.3333 29.5667 10.3333 33.6667 10.3333 33.6667H23.6666C23.6666 33.6667 23.6666 29.5667 18.6666 28.8V25.1667C20.2672 24.838 21.7362 24.047 22.8916 22.8916C24.047 21.7362 24.838 20.2673 25.1666 18.6667H30.3333C32.1666 18.6667 33.6666 17.1667 33.6666 15.3333V3.66668H25.3333ZM3.66665 15.3333V7.00001H8.66665V15.3333H3.66665ZM30.3333 15.3333H25.3333V7.00001H30.3333V15.3333Z" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Peringkat Nasional</h2>
					</div>
				</div>
				<div>
					<p>Bandingkan hasilmu dengan para pesaing lainnya di Ranking Nasional! Tingkatkan terus kesiapanmu menuju CPNS 2021.</p>
				</div>
			</article> -->
			<!-- <article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 22.5L0 27.4V13.3333H5V22.5ZM13.3333 19.4333L10.7167 17.2L8.33333 19.4V6.66667H13.3333V19.4333ZM21.6667 16.6667L16.6667 21.6667V0H21.6667V16.6667ZM26.35 16.35L23.3333 13.3333H31.6667V21.6667L28.6833 18.6833L16.6667 30.6L10.8833 25.5667L4.58333 31.6667H0L10.7833 21.1L16.6667 26.0667" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Lihat Progress</h2>
					</div>
				</div>
				<div>
					<p>Kerjakan lebih banyak try outnya, lihat bagaimana persiapanmu semakin matang dengan melihat menu statistik di akun kamu.</p>
				</div>
			</article> -->
			<article class="col-md-6 col-lg-4 mb-4 mb-md-5">
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<span class="main-cover-icon">
							<svg width="39" height="31" viewBox="0 0 39 31" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.99996 0.666656H32.3333C33.2174 0.666656 34.0652 1.01785 34.6903 1.64297C35.3154 2.26809 35.6666 3.11594 35.6666 3.99999V7.33332H29V3.99999H7.33329V24H22.3333V27.3333H3.99996C3.1159 27.3333 2.26806 26.9821 1.64294 26.357C1.01782 25.7319 0.666626 24.884 0.666626 24V3.99999C0.666626 3.11594 1.01782 2.26809 1.64294 1.64297C2.26806 1.01785 3.1159 0.666656 3.99996 0.666656ZM27.3333 10.6667H37.3333C37.7753 10.6667 38.1992 10.8423 38.5118 11.1548C38.8244 11.4674 39 11.8913 39 12.3333V29C39 29.442 38.8244 29.8659 38.5118 30.1785C38.1992 30.4911 37.7753 30.6667 37.3333 30.6667H27.3333C26.8913 30.6667 26.4673 30.4911 26.1548 30.1785C25.8422 29.8659 25.6666 29.442 25.6666 29V12.3333C25.6666 11.8913 25.8422 11.4674 26.1548 11.1548C26.4673 10.8423 26.8913 10.6667 27.3333 10.6667ZM29 14V25.6667H35.6666V14H29Z" fill="currentColor"/>
							</svg>
						</span>
					</div>
					<div>
						<h2>Akses Dimana Saja</h2>
					</div>
				</div>
				<div>
					<p>TryOut CPNS bisa diakses melalui laptop, tablet maupun handphone. Memudahkan Anda belajar dimana saja dan kapan saja.</p>
				</div>
			</article>
		</div>
	</div>
</main>
@endsection