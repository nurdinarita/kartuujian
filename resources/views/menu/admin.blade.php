<li class="sidebar-title">Menu Utama</li>
<li class="active-page">
    <a href="{{ url('admin') }}" class="active"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
</li>
<li>
    <a href="#"><i class="material-icons">fact_check</i>Soal Tryout<i class="material-icons has-sub-menu">expand_more</i></a>
    <ul class="sub-menu">
        <li>
            <a href="{{ url('admin/tryout/question') }}">Soal</a>
        </li>
        <li>
            <a href="{{ url('admin/tryout/tryout') }}">Tryout</a>
        </li>
    </ul>
</li>
<li>
    <a href="#"><i class="material-icons">assignment</i>Riwayat Ujian<i class="material-icons has-sub-menu">expand_more</i></a>
    <ul class="sub-menu">
        <li>
            <a href="{{ url('admin/exam/buy') }}">Pembelian</a>
        </li>
        <li>
            <a href="{{ url('admin/exam/running') }}">Sedang Berjalan</a>
        </li>
        <li>
            <a href="{{ url('admin/exam/result') }}">Hasil</a>
        </li>
    </ul>
</li>
<li>
    <a href="{{ url('admin/member') }}"><i class="material-icons">groups</i>Member</a>

</li>