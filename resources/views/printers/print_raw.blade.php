@extends('layouts.master')
@section('content')
    <div class="p-4 h-auto pt-20 md:ml-64 ">
        <form action="{{ url('printRaw') }}" method="POST" id="printRawForm">
            @csrf
            <label for="rawData">Raw Data:</label>
            <input type="text" id="rawData" name="raw_data">
            <button type="submit">Print Raw Data</button>
        </form>
    </div>
    {{-- <script>
        function printRaw() {
            // Get the raw data from the input field
            var rawData = document.getElementById('rawData').value;

            // Get the CSRF token from the meta tag
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send an AJAX request to the printRaw endpoint
            fetch('/printRaw', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'text/plain',
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token
                    },
                    body: rawData // Pass the raw data directly
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response
                    console.log(data);
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                });
        }
    </script> --}}
@endsection
