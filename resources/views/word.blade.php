@extends('layouts.default.app')

@section('title', $word->word)

@section('content')
    <div id="content">
        <div id="inner">
            <!--        <div class="dictionary entry">-->
            <h1>{{ $word->word }}
                @if(session('admin') && session('admin') === '1')
                    <a style="border-bottom: none;" href="?q=<?=$trig?>&action=edit"><i class="far fa-edit"></i></a>
                @endif
            </h1>
            <p class="definition">{{ $word->translation }}</p>
            <p class="etymology">{{ $word->etymology }}</p>
            <p class="example"><strong>Examples:</strong></p>
            <div class="translations">
                @foreach($translationList as $translation)
                    <div class="entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10"><a href="#">{{ $translation->trigedasleng }}</a></td></tr>
                            <tr class="tgs" style="display: table-row;">
                                @foreach(explode(' ', $translation->trigedasleng) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="ety" style="display: table-row;">
                                @foreach(explode(' ', $translation->etymology) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="leipzig" style="display: table-row;">
                                @foreach(explode(' ', $translation->leipzig) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="en_text">
                                <td colspan="10">{{ $translation->trigedasleng }}</td>
                            </tr>
                            </tbody>
                        </table>

                        @if($translation->audio !== '')
                        <audio controls="">
                            <source src="/{{ $translation->audio }}" type="audio/mpeg">
                        </audio>
                        @endif
                    </div>
                    </br>
                @endforeach
            </div>
            <p class="notes">{{ $word->note }}</p>

            <h3 class="citations">Source:</h3>
            <ul class="citations">
                <li><a href="{{ $citation->url }}">{{ $citation->title }}</a></li>
            </ul>
            <div id="output"></div>
        </div>
    </div>
    <!--<script src="./js/comments.js"></script>-->
@endsection
