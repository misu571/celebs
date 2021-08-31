<footer class="footer py-0">
    <div class="container-fluid">
        <div class="row text-center">
            {{-- <div class="col-md text-md-left">
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">{{ config('app.name') }}</a>
                        </li>
                        <li>
                            <a href="#">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
            <div class="col-md text-md-right">
                <div class="copyright" id="date">
                    Copyright, <span class="logo">{{ config('app.name') }}</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    const x = new Date().getFullYear();
    let date = document.getElementById('date');
    date.innerHTML = '&copy; ' + x + date.innerHTML;
</script>