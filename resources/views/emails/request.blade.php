<body>
    <p>Guten Tag {{ $request->user->company }}</p>

    <p>
        Sie haben soeben das Angebot Nr. {{ $request->offer->id }} erfolgreich angenommen.<br/>
        Der Anbieter erhält von uns eine E-Mail mit Ihrer Bestellung.
    </p>

    <p>
        Besten Dank.
    </p>

    <p>
        Freundliche Grüsse<br/>
        Toolshare
    </p>
</body>