@extends('layouts.main2')

@section('title')
    Clinical Pathway - Medify
@endsection

@section('content')
    <style type="text/css">
        .subheading {
            font-size: 1.2rem;
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
            <div class="row row-eq-height mb-5">
                <div class="col-sm-6">
                    <h2>Clinical Pathway</h2>
                    <p class="subheading">Referensi Dalam Menangani Kasus</p>
                </div>

                <div class="col-sm-4 ml-auto text-right">
                    <a href="/clinical-pathways/new" class="btn btn-primary">Buat Baru</a>
                    <input type="text" class="form-control my-3" id="search-article" placeholder="Cari">
                </div>
            </div>

            <div class="row row-deck" id="articles"></div>
        </div>
    </main>

    <script id="article-template" type="text/html">
        <div class="col-md-3 article">
            <div class="block">
                <div class="block-content">
                    <ul class="list-inline categories">
                        <% categories.forEach(function (category) { %>
                            <li class="list-inline-item">
                                <a href="/clinical-pathways?category=<%= category.slug %>" class="badge badge-<%= category.cssClass %> text-capitalize"><%= category.name %></a>
                            </li>
                        <% }); %>
                    </ul>
                    <h4><a href="/clinical-pathways/<%= id %>"><%= title %></a></h4>
                    <p class="diagnosis"><%= icd10.codeIcd %> - <%= icd10.longDesc %></p>
                    <p><%= content %></p>
                    <div class="footer">
                        <span class="mr-3"><%= numberOfFiles %> References</span>
                        <span><%= views %> Views</span>
                    </div>
                </div>
            </div>
        </div>
    </script>
@endsection

@section('js')
    <script src="{{ URL::asset('/assets/js/filter.min.js') }}" type="text/javascript"></script>
    <script>
        var articles = [
            @foreach ($articles as $article)
                {   
                    "id": {{ $article->id }},
                    "icd10": {
                        "codeIcd": "{{ $article->icd10->code_icd }}",
                        "longDesc": "{{ $article->icd10->long_desc }}",
                    },
                    "title": "{{ addslashes($article->title) }}",
                    "content": "{{ addslashes(str_limit(str_replace(array("\r\n", "\n", "\r"), "", strip_tags($article->content)), 140)) }}",
                    "numberOfFiles": {{ $article->files->count() }},
                    "views": {{ $article->views }},
                    "categories": [
                        @foreach ($article->categories as $category)
                            {
                                "slug": "{{ $category->slug }}",
                                "name": "{{ $category->name }}",
                                "cssClass": "{{ $category->css_class }}"
                            },
                        @endforeach
                    ]
                },
            @endforeach
        ];
    </script>
    <script>
        var FJS = FilterJS(articles, '#articles', {
          template: '#article-template',
          search: { ele: '#search-article', fields: ['title', 'icd10.codeIcd', 'icd10.longDesc', 'categories.name']  }
        });
    </script>
@endsection