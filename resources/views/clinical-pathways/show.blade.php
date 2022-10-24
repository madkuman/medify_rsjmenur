@extends('layouts.main2')

@section('title')
    {{ $article->title }} - Clinical Pathway - Medify
@endsection

@section('content')
    <style type="text/css">
        .block-content.large {
            width: 85%;
            padding-top: 40px;
            margin-bottom: 40px;
        }

        .back-link {
            margin-bottom: 40px;
        }

        .article-single .categories .badge {
            font-size: 100%;
        }

        .article-single .diagnosis {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .article-info {
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .article-info span:not(:last-child) {
            margin-right: 30px;
        }

        .article-content {
            font-size: 1.1rem;
        }

        .article-single .file {
            border: 1px solid #e8e8e8;
            margin: 10px;
            padding: 15px 10px;
            text-align: center;
            overflow: hidden;
            word-wrap: break-word;
        }

        .article-single .file i {
            display: block;
            font-size: 30px;
            padding: 10px;
        }

        .article-content:not(:last-child) {
            margin-bottom: 40px;
        }

        .article .block-content {
            padding: 18px;
        }

        .article h4 a {
            color: #000;
        }

        .article .diagnosis {
            font-size: 1.2rem !important;
            color: #6c757d;
        }

        .article p {
            font-size: 1.1rem;
        }

        .article .footer {
            font-weight: 700;
            color: #42a5f5;
        }

        .categories {
            margin-bottom: .6rem;
        }

        .categories:empty {
            display: none;
        }

        .categories .list-inline-item {
            margin-right: .2rem;
            margin-bottom: .4rem;
        }

        .categories .badge {
            font-size: 90%;
            padding: 4px 8px;
        }
    </style>

    <main id="main-container">
        <div class="content">
            <div class="block">
                <div class="block-content large">
                    <div class="back-link"><a href="/clinical-pathways"><i class="far fa-arrow-alt-circle-left"></i> Kembali ke Menu Utama</a></div>

                    <div class="article-single">
                        <a href="/clinical-pathways/{{ $article->id }}/edit" class="btn btn-primary float-right">Edit</a>


                        <ul class="list-inline categories">
                            @foreach ($article->categories as $category)
                                <li class="list-inline-item">
                                    <a href="/clinical-pathways?category={{ $category->slug }}" class="badge badge-{{ $category->css_class }} text-capitalize">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <h1>{{ $article->title }}</h1>
                        <p class="diagnosis">{{ $article->icd10->code_icd }} - {{ $article->icd10->long_desc }}</p>
                        <div class="article-info">
                            <span>Dibuat Oleh: <a href="/profil/{{ $article->user->id }}" class="font-weight-bold">{{ $article->user->name }}</a></span>
                            <span>{{ date('d F Y, H.i', strtotime($article->created_at)) }}</span>
                        </div>
                        <div class="article-content">{!! $article->content !!}</div>

                        @if (!$article->files->isEmpty())
                            <h5>SUMBER FILE</h5>
                            <div class="row">
                                @foreach ($article->files as $file)
                                    <div class="col-sm-2 file">
                                        <i class="far fa-file-alt"></i>
                                        <a href="/uploads/clinical-pathways/{{ $file->name }}">{{ $file->original_name }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (!$related_articles->isEmpty())
                <h5>REFERENSI DENGAN DIAGNOSIS YANG SAMA</h5>

                <div class="row row-deck">
                    @foreach ($related_articles as $related_article)
                        <div class="col-md-3 article">
                            <div class="block">
                                <div class="block-content">
                                    <ul class="list-inline categories">
                                        @foreach ($related_article->categories as $category)
                                            <li class="list-inline-item">
                                                <a href="/clinical-pathways?category={{ $category->slug }}" class="badge badge-{{ $category->css_class }} text-capitalize">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <h4><a href="/clinical-pathways/{{ $related_article->id }}">{{ $related_article->title }}</a></h4>
                                    <p class="diagnosis">{{ $related_article->icd10->code_icd }} - {{ $related_article->icd10->long_desc }}</p>
                                    <p>{{ str_limit(str_replace(array("\r\n", "\n", "\r"), "", strip_tags($related_article->content)), 140) }}</p>
                                    <div class="font-weight-bold">
                                        <span class="mr-3">{{ $related_article->files->count() }} References</span>
                                        <span>{{ $related_article->views }} Views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
@endsection

