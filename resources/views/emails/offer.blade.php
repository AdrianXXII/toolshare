<body>
    <p>Guten Tag {{ $request->offer->user->company }}</p>

    <p>
        Hier Angebot Nr. {{ $request->offer->id }} wurde soeben erfolgreich von {{ $request->user->company }} angenommen.<br/>
        Im Anhang finden Sie die entsprechende Bestellung.
    </p>

    <p>
        Freundliche Grüsse<br/>
        Toolshare
    </p>
</body>