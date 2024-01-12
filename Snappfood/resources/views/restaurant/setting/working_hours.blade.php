@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        <h1>Working Hours</h1>

        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li class="text-warning">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="/restaurant/{{$restaurant->name}}/settings/change_working_hours" method="POST">
            @csrf
            @method('POST')

            <!-- Saturday -->
            <div class="mb-3">
                <h4>Saturday</h4>
                <h5>Is your restaurant open on Saturday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sat-open-yes" name="sat-open" value="1">
                    <label class="form-check-label" for="sat-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sat-open-no" name="sat-open" value="0" >
                    <label class="form-check-label" for="sat-open-no">No</label>
                </div>

                <label for="sat-start">Start time</label>
                <input id="sat-start" type="time" name="sat_start">
                <label for="sat-end">End time</label>
                <input id="sat-end" type="time" name="sat_end">
            </div>

            <!-- Sunday -->
            <div class="mb-3">
                <h4>Sunday</h4>
                <h5>Is your restaurant open on Sunday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sun-open-yes" name="sun-open" value="1">
                    <label class="form-check-label" for="sun-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sun-open-no" name="sun-open" value="0">
                    <label class="form-check-label" for="sun-open-no">No</label>
                </div>

                <label for="sun-start">Start time</label>
                <input id="sun-start" type="time" name="sun_start">
                <label for="sun-end">End time</label>
                <input id="sun-end" type="time" name="sun_end">
            </div>

            <!-- Monday -->
            <div class="mb-3">
                <h4>Monday</h4>
                <h5>Is your restaurant open on Monday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="mon-open-yes" name="mon-open" value="1">
                    <label class="form-check-label" for="mon-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="mon-open-no" name="mon-open" value="0">
                    <label class="form-check-label" for="mon-open-no">No</label>
                </div>

                <label for="mon-start">Start time</label>
                <input id="mon-start" type="time" name="mon_start">
                <label for="mon-end">End time</label>
                <input id="mon-end" type="time" name="mon_end">
            </div>

            <!-- tuesday -->
            <div class="mb-3">
                <h4>Tuesday</h4>
                <h5>Is your restaurant open on Tuesday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="tue-open-yes" name="tue-open" value="1">
                    <label class="form-check-label" for="tue-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="tue-open-no" name="tue-open" value="0">
                    <label class="form-check-label" for="tue-open-no">No</label>
                </div>

                <label for="tue-start">Start time</label>
                <input id="tue-start" type="time" name="tue_start">
                <label for="tue-end">End time</label>
                <input id="tue-end" type="time" name="tue_end">
            </div>

            <!-- wednesday -->
            <div class="mb-3">
                <h4>Wednesday</h4>
                <h5>Is your restaurant open on Wednesday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="wed-open-yes" name="wed-open" value="1">
                    <label class="form-check-label" for="wed-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="wed-open-no" name="wed-open" value="0">
                    <label class="form-check-label" for="wed-open-no">No</label>
                </div>

                <label for="wed-start">Start time</label>
                <input id="wed-start" type="time" name="wed_start">
                <label for="wed-end">End time</label>
                <input id="wed-end" type="time" name="wed_end">
            </div>

            <!-- thursday -->
            <div class="mb-3">
                <h4>Thursday</h4>
                <h5>Is your restaurant open on Thursday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="thu-open-yes" name="thu-open" value="1">
                    <label class="form-check-label" for="thu-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="thu-open-no" name="thu-open" value="0">
                    <label class="form-check-label" for="thu-open-no">No</label>
                </div>

                <label for="thu-start">Start time</label>
                <input id="thu-start" type="time" name="thu_start">
                <label for="thu-end">End time</label>
                <input id="thu-end" type="time" name="thu_end">
            </div>

            <!-- friday -->
            <div class="mb-3">
                <h4>Friday</h4>
                <h5>Is your restaurant open on Friday?</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="fri-open-yes" name="fri-open" value="1">
                    <label class="form-check-label" for="fri-open-yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="fri-open-no" name="fri-open" value="0">
                    <label class="form-check-label" for="fri-open-no">No</label>
                </div>

                <label for="fri-start">Start time</label>
                <input id="fri-start" type="time" name="fri_start">
                <label for="fri-end">End time</label>
                <input id="fri-end" type="time" name="fri_end">
            </div>

            <button class="btn btn-warning" type="submit">Submit</button>
        </form>
    </div>
@endsection
