@extends('layouts.master')
@section('content')
    <div class="p-4 h-auto pt-20 md:ml-64 ">
        <h1>Available Printers</h1>

        @if (!empty($printers))
            <form action="{{ url('setPrinter') }}" method="POST" id="printer">
                @csrf
                <label for="printer">Select Printer:</label>
                <select name="printer" id="printer">
                    @foreach ($printers as $printer)
                        <option value="{{ $printer }}">{{ $printer }}</option>
                    @endforeach
                </select>
                <button type="submit">Select</button>
            </form>
        @else
            <p>No printers found.</p>
        @endif
    </div>

@endsection
