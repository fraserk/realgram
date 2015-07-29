@extends('master')
    @section('content')
        <section id="instagram">
            <h1>Images </h1>
            <ul>
                <li v-repeat="t : instagrams | orderBy 'instagram' -1"">
                    ---<img src=@{{t.instagram}} alt="" width="20" />

                </li>
            </ul>
        </section>
    @stop
