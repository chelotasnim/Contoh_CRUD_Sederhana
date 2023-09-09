<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('dashboard/style.css') }}">
    <title>Inventaris Barang | Dashboard</title>
</head>
<body>
    <div class="page">
        <div class="card">
            <div class="side-bar">
                <a href="{{ url('kategori') }}" class="nav-item  @if($page == 'kategori'){{ 'active' }}@endif">
                    <p>Data Kategori</p>
                </a>
                <a href="{{ url('buku') }}" class="nav-item  @if($page == 'book'){{ 'active' }}@endif">
                    <p>Data Buku</p>
                </a>
            </div>
            <div class="nav-bar">
                <div class="nav-label">Inventaris Buku</div>
                <a class="logout" href="{{ url('logout') }}">Logout</a>
            </div>
            <div class="content-wrapper">