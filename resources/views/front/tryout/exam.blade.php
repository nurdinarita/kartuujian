<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <meta name="author" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedang Ujian</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/swiper-bundle.min.css') }}">
    <!-- SEDANG UJIAN CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/sedang-ujian.css') }}">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style type="text/css">
        .swiper-container{
            z-index: 20;
        }
    </style>
</head>
<body>
    <!-- NAV -->
    <nav id="nav">
        <div class="container-cpns">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-between">
                    <h1>{{ $tryout->title }}</h1>
                    <strong id="timer">0:00:00</strong>
                </div>
            </div>
        </div>
    </nav>
    <!-- MAIN -->
    <main id="main">
        <div class="container-cpns">
            <!-- SOAL & JAWABAN -->
            <div class="row mb-3">
                <div class="col-lg-12">
                    <!-- NO SOAL -->
                    <div class="no-soal-ujian mb-3">
                        <h5>Soal Nomor {{ $number }}</h5>
                    </div>
                    <!-- SOAL -->
                    <div class="soal-ujian mb-4">
                        <p>{{ $question->question }}</p>
                        @if(isset($question->question_image) and $question->question_image != '')
                            <img src="{{ asset('storage/images/question/'.$question->question_image)}}" />
                        @endif
                    </div>
                    <!-- JAWABAN -->
                    @foreach($answers as $k => $v)
                    <div class="jawaban-ujian" data-answer="{{ $v->answer }}" data-target="{{ chr($k+65) }}">
                        <strong>{{ chr($k + 65) }}</strong>
                        <p class="list-jawaban @if($myAnswer && $myAnswer->answer == $v->answer) jawaban-dipilih @endif" id="answer-{{ chr($k+65) }}">{{ $v->answer }}<br>
                        @if(isset($v->answer_image) and $v->answer_image != '')
                            
                                <img src="{{ asset('storage/images/answer/'.$v->answer_image)}}" />
                            </p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- SECTION PAGINATION -->
    <section id="section">
        <div class="container-cpns">
            <!-- SWIPE UP -->
            <div class="row mt-2 mb-3 d-md-none">
                <div class="col-lg-12 d-flex align-items-center justify-content-center">
                    <button type="button" class="btn-swipe-up-down" data-button="close">
                        <svg class="mr-2" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.41 7.41L6 2.83L10.59 7.41L12 6L6 0L0 6L1.41 7.41Z" fill="#363636" fill-opacity="0.5"/>
                        </svg>
                        <span>Swipe ke atas</span>
                    </button>
                </div>
            </div>
            <!-- LEWATI & RAGU & SIMPAN -->
            <div class="row row-btn-3">
                <div class="col-lg-12 d-flex align-items-center justify-content-between justify-content-md-end">
                    @if($counter['questions'] != $number)
                    <a href="{{ url()->current().'?q='.($number+1) }}" type="button" class="btn-lewati ml-md-3">Lewati</a>
                    @endif
                    {{-- <button onclick="markDoubt()" type="button" class="btn-ragu-ragu btn-ragu-outline @if($myAnswer && $myAnswer->doubt) btn-ragu @endif ml-md-3">Ragu - Ragu</button> --}}
                    @if($counter['questions'] != $number)
                    <a href="{{ url()->current().'?q='.($number+1) }}" type="button" class="btn-simpan ml-md-3">Simpan & Lanjutkan</a>
                    @else
                        @if($counter['answered'] == $counter['questions'])
                            <button type="button" class="selesai-ujian ml-md-3" name="modal-open" data-toggle="modal" data-target="#ujianSelesaiModal">Selesai Ujian</button>
                        @else
                            <a href="{{ url()->current().'?q='.($number)}}" type="button" class="btn-simpan ml-md-3">Simpan</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="row mb-4 mb-md-5">
                <div class="col-lg-12 d-flex align-items-center justify-content-between flex-wrap">
                    <!-- LINE -->
                    <div class="section-line-top-bottom mb-4 mb-md-5"></div>
                    <div class="section-list-soal">
                        <!-- Swiper -->
                        <div class="swiper-nav">
                            <!-- DESKTOP -->
                            <div class="swiper-button-prev-review d-none d-md-block">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 13.5V16.5H12L17.25 21.75L15.12 23.88L6.24 15L15.12 6.12L17.25 8.25L12 13.5L24 13.5ZM0 15C0 11.0218 1.58035 7.20644 4.3934 4.3934C7.20644 1.58035 11.0218 0 15 0C16.9698 0 18.9204 0.387985 20.7403 1.14181C22.5601 1.89563 24.2137 3.00052 25.6066 4.3934C28.4196 7.20644 30 11.0218 30 15C30 18.9782 28.4196 22.7936 25.6066 25.6066C22.7936 28.4196 18.9782 30 15 30C13.0302 30 11.0796 29.612 9.25975 28.8582C7.43987 28.1044 5.78628 26.9995 4.3934 25.6066C3.00052 24.2137 1.89563 22.5601 1.14181 20.7403C0.387985 18.9204 0 16.9698 0 15ZM3 15C3 18.1826 4.26428 21.2348 6.51472 23.4853C8.76515 25.7357 11.8174 27 15 27C18.1826 27 21.2348 25.7357 23.4853 23.4853C25.7357 21.2348 27 18.1826 27 15C27 11.8174 25.7357 8.76515 23.4853 6.51472C21.2348 4.26428 18.1826 3 15 3C11.8174 3 8.76515 4.26428 6.51472 6.51472C4.26428 8.76515 3 11.8174 3 15Z" fill="#363636" fill-opacity="0.25"/>
                                </svg>
                            </div>
                            <div class="swiper-button-next-review d-none d-md-block">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 16.5V13.5H18L12.75 8.25L14.88 6.12L23.76 15L14.88 23.88L12.75 21.75L18 16.5H6ZM30 15C30 18.9782 28.4196 22.7936 25.6066 25.6066C22.7936 28.4196 18.9782 30 15 30C13.0302 30 11.0796 29.612 9.25975 28.8582C7.43986 28.1044 5.78628 26.9995 4.3934 25.6066C1.58035 22.7936 0 18.9782 0 15C0 11.0218 1.58035 7.20644 4.3934 4.3934C7.20644 1.58035 11.0218 0 15 0C16.9698 0 18.9204 0.387987 20.7403 1.14181C22.5601 1.89563 24.2137 3.00052 25.6066 4.3934C26.9995 5.78628 28.1044 7.43986 28.8582 9.25975C29.612 11.0796 30 13.0302 30 15ZM27 15C27 11.8174 25.7357 8.76515 23.4853 6.51472C21.2348 4.26428 18.1826 3 15 3C11.8174 3 8.76515 4.26428 6.51472 6.51472C4.26428 8.76515 3 11.8174 3 15C3 18.1826 4.26428 21.2348 6.51472 23.4853C8.76515 25.7357 11.8174 27 15 27C18.1826 27 21.2348 25.7357 23.4853 23.4853C25.7357 21.2348 27 18.1826 27 15Z" fill="#363636" fill-opacity="0.9"/>
                                </svg>
                            </div>
                            <!-- MOBILE -->
                            <div class="swiper-button-prev-review d-flex d-md-none">
                                <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 7.139L3.09042 4.04858L0 0.951417L0.951417 0L5 4.04858L0.951417 8.09717L0 7.139Z" fill="#363636" fill-opacity="0.7"/>
                                </svg>
                            </div>
                            <div class="swiper-button-next-review d-flex d-md-none">
                                <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 7.139L3.09042 4.04858L0 0.951417L0.951417 0L5 4.04858L0.951417 8.09717L0 7.139Z" fill="#363636" fill-opacity="0.7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($numbers as $key => $value)
                                <div class="swiper-slide">
                                    @foreach($value as $k => $v)
                                    <a @if($v == 'blue') href="javascript:void(0)" @else href="{{ url()->current().'?q='.($key*20+($k+1)) }}" @endif class="daftar-nomor-soal daftar-nomor-soal-{{ $v }}">{{ $k+1 }}</a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="section-line-top-bottom d-block d-md-none my-4"></div>
                    <span class="line-list-info d-none d-lg-block"></span>
                    <div class="section-info-soal">
                        <div>
                            <p>Jumlah Soal</p>
                            <strong>{{ $counter['questions'] }}</strong>
                        </div>
                        <div class="mx-5">
                            <p>Soal Dijawab</p>
                            <strong>{{ $counter['answered'] }}</strong>
                        </div>
                        <div>
                            <p>Belum Dijawab</p>
                            <strong>{{ $counter['notAnswered'] }}</strong>
                        </div>
                    </div>
                    <!-- LINE -->
                    <div class="section-line-top-bottom mt-4 mt-md-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <!-- <button type="button" class="selesai-ujian" name="modal-open" data-toggle="modal" data-target="#ujianSelesaiModal">Selesai Ujian</button> -->
                </div>
            </div>
        </div>
    </section>
    <!-- MODAL -->
    <div class="modal fade" id="ujianSelesaiModal" tabindex="-1" aria-labelledby="ujianSelesaiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <!-- HEAD MODAL -->
                        <div class="row">
                            <div class="col-lg-12 py-3 d-flex align-items-start">
                                <button type="button" class="close close-modal-ujian" data-dismiss="modal" aria-label="Close">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 1.51071L13.4893 0L7.5 5.98929L1.51071 0L0 1.51071L5.98929 7.5L0 13.4893L1.51071 15L7.5 9.01071L13.4893 15L15 13.4893L9.01071 7.5L15 1.51071Z" fill="#363636" fill-opacity="0.5"/>
                                    </svg>
                                </button>
                                <div class="text-ujian-modal">
                                    <div class="d-flex align-items-center mb-3 mb-md-2">
                                        <div class="file-ujian-modal">
                                            <span>
                                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V18C0 19.11 0.89 20 2 20H14C15.11 20 16 19.11 16 18V6L10 0ZM14 18H2V2H9V7H14V18ZM8.54 16.5V14.5H4.54V12.5H8.54V10.5L11.54 13.5L8.54 16.5Z" fill="#2D6187"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <h5>Selesai Ujian</h5>
                                    </div>
                                    <div class="mb-4">
                                        <p>Apakah kamu yakin?<br />Total soal yang Anda jawab adalah <strong>{{ $counter['answered'] }}/{{ $counter['questions'] }}</strong></p>
                                    </div>
                                    <div class="button-footer d-flex flex-wrap justify-content-between">
                                        <button type="button" class="selesaiModal mb-2 mb-md-0" name="selesaiUjianModal" onclick="$('#form-finish').submit()">Selesai Ujian</button>
                                        <button type="button" class="periksaModal" name="periksaKembaliModal" data-dismiss="modal" aria-label="Close">Periksa Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" id="form-finish" action="{{ url()->current().'/finish' }}">
        @csrf
    </form>

    @include('includes.loading')
    <!-- JQUERY -->
    <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SWIPER JS -->
    <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
    <!-- SEDANG UJIAN JS -->
    <script src="{{ asset('front/js/sedang-ujian.js') }}"></script>

    <script type="text/javascript">
        var token = '{{ csrf_token() }}';
        var remainingTime = {{ $exam->remaining_time }};
        var timer = '0:00:00';

        $(document).ready(function(){
            $(".jawaban-ujian").on("click", function(){
                let answer = $(this).data('answer');
                let target = $(this).data('target');

                $(".overflow").css('display', 'flex');
                $.ajax({
                    url: '{{ url()->current() }}' + '/answer/' + '{{ $question->id }}',
                    method: 'POST',
                    data: {
                        _token: token,
                        answer: answer,
                        number: {{ $number }},
                    },
                    success: function(d){
                        if(d){
                            $(".list-jawaban.jawaban-dipilih").removeClass('jawaban-dipilih');
                            $("#answer-"+target).addClass('jawaban-dipilih');
                        }
                        $(".overflow").css('display', 'none');
                    },
                    error: function(e){
                        console.log(e);
                        $(".overflow").css('display', 'none');
                    }
                })
            })

            setInterval(function(){
               remainingTime--;

               var hours = Math.floor(((remainingTime*1000) % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
               var minutes = Math.floor(((remainingTime*1000) % (1000 * 60 * 60)) / (1000 * 60));
               var seconds = Math.floor(((remainingTime*1000) % (1000 * 60)) / 1000);

               $("#timer").html(hours + ":" + minutes + ":" + seconds);
               updateTime();
           }, 1000);
        });

        function markDoubt(){
            let active = $(".btn-ragu-ragu").hasClass('btn-ragu') ? 0 : 1;

            $(".overflow").css('display', 'flex');
            $.ajax({
                url: '{{ url()->current() }}' + '/doubt/' + '{{ $question->id }}',
                method: 'POST',
                data: {
                    _token: token,
                    status: active,
                },
                success: function(d){
                    if(d){
                        if(active == 0){
                            $(".btn-ragu-ragu").removeClass('btn-ragu');
                        }else{
                            $(".btn-ragu-ragu").addClass('btn-ragu');
                        }
                    }
                    $(".overflow").css('display', 'none');
                },
                error: function(e){
                    console.log(e);
                    $(".overflow").css('display', 'none');
                }
            })
        }

        function updateTime(){
         $.ajax({
            url: '{{ url()->current() }}' + '/tick',
            method: 'POST',
            data: {
                _token: token,
                remaining_time: remainingTime
            },
            success: function(d){
                if(d){
                    console.log("time updated");
                }
            },
            error: function(e){
                console.log(e);
            }
        })
     }

     function finishExam(){
         $.ajax({
            url: '{{ url()->current() }}' + '/finish',
            method: 'POST',
            data: {
                _token: token,
            },
            success: function(d){
                if(d){
                    window.location.href = '{{ url("result/".$tryout->slug) }}';
                }
            },
            error: function(e){
                console.log(e);
            }
        })
     }
 </script>
</body>
</html>