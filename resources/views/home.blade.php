@extends('master')
    @section('content')
        <section id="instagram">
            <h1>Images </h1>
            <ul>
                <li v-repeat="t : instagrams">
                    <img src="" alt="" /> 

                </li>
            </ul>
        </section>
    @stop
