@extends('master')
    @section('content')
        <section id="instagram">
            <h1>Images </h1>
            <ul>
                <li v-repeat="t : instagrams">
                    ---<img src=@{{t.instagram}} alt="" width="100" /> @{{t.tag}}

                </li>
            </ul>
        </section>
    @stop
