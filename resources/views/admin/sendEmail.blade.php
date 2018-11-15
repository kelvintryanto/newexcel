@extends('admin.layout.auth')

@section('content')
<div class="container" style="margin-left: 0px; margin-right: 0px; padding: 15px; width: 100%;">
    <div class="row">
        <div class="col-md-12">
             <!-- @if(\Session::has('alert-failed'))
                <div class="alert alert-failed">
                    <div>{{Session::get('alert-failed')}}</div>
                </div>
                @endif
                @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
                @endif -->
            <div>
                <form action="{{ url('admin/sendEmail') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-hover" style="font-size: 12px;">
                        <tr>
                            <th>Nama</th>
                            <th>Gaji</th>
                            <th>Email</th>
                            <th>Send Email</th>
                        </tr>


                        <?php
                        $conn=mysqli_connect("localhost","root","","newexcel");
                        if($conn->connect_error){
                            die("Connection failed:". $conn-> connect_error);
                        }
                        $sql = "SELECT nama,ptkp,email from karyawan, users WHERE karyawan.nama = users.name";
                        $result = $conn-> query($sql);


                        if ($result-> num_rows > 0) {
                            while ($row = $result-> fetch_assoc()) {
                                echo "<tr><td>".$row["nama"]."</td><td>".$row["ptkp"]."</td><td>".$row["email"]."</td><td>"."<button>send</button>"."</td></tr>";

                            }
                            echo "</table>";
                        }
                        else{
                            echo "0 result";
                        }
                        $conn-> close();
                        ?> 


                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection