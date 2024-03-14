<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/style.css">

    <title>AdminHub</title>
</head>

<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/admin/home" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <ul class="side-menu top">
            <li class="@yield('dashboard')">
                <a href="/">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <li>
                <a href="/profile">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <div id="dynamic-content">
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="/assets/img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Flights : {{ $_GET['flight_type'] ?? 'DEPARTURE' }}</h3>
                        <form action="/" method="GET">
                            <select name="flight_type" >
                                @if (isset($_GET['flight_type']))
                                    <option value="{{ $_GET['flight_type'] }}">{{ $_GET['flight_type'] }}</option>
                                @endif
                                <option value="DEPARTURE">DEPARTURE</option>
                                <option value="ARRIVAL">ARRIVAL</option>
                            </select>

                            <button type="submit" class="btn btn-success" >Submit</button>

                        </form>

                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Movement</th>
                                <th>Flight</th>
                                <th>Airport</th>
                                <th>BC</th>
                                <th>plan</th>
                                <th>schedule</th>
                                <th>fact</th>
                                <th>status</th>
                                <th>Check in Plan</th>
                                <th>Baggage plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($flights) == 0)
                                <tr>
                                    <td colspan="5" class="h5 text-center text-muted">Ma'lumot kiritilmagan</td>
                                </tr>
                            @endif
                            @foreach ($flights as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $item['movement'] }}</td>
                                    <td>{{ $item['aircompany'] }} {{ $item['flightnumber'] }}</td>
                                    <td>{{ $item['airport'] }}</td>
                                    <td>{{ $item['aircrafttype'] }}</td>
                                    <td>{{ $item['plan'] }}</td>
                                    <td>{{ $item['sched'] }}</td>
                                    <td>{{ $item['fact'] }}</td>
                                    <td>{{ $item['flight_status'] }}</td>
                                    <td>{{ $item['check_in']['plan'] ?? '' }}</td>
                                    <td>{{ $item['baggage']['plan'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </main>

    </section>
    </div>
    <!-- CONTENT -->

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="/assets/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: '/', // AJAX so'rovi uchun route
                    type: 'GET',
                    success: function(response) {
                        $('#dynamic-content').html(response); // Yangi ma'lumotlarni ko'rsatish
                    },
                    error: function(xhr) {
                        console.log(xhr
                        .responseText); // Xatoliklar uchun konsolga xabar chiqarish
                    }
                });
            }, 60000); // 60 sekunddan so'ng bir marta so'rov yuborish
        });
    </script>
</body>

</html>
