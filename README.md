# VTEC_Zahlarten
Modul für Oxid CE ab 4.9.x

Lizenz: GNU GPL V3.0

Erweitert die Bonitätspunkte in den Zahlarten. Es kann ein "Ab Bonitätsindex" und NEU ein "bis Bonitätsindex" eingegeben 
werden. Je nach Bonität des Kunden werden nur die Zahlungsarten angezeigt die der Bonität des Kunden entsprechen.

Installation:

den Modulordner in copy_this in das modules Verzeichnis hochladen (binär!)
Datenbank-Sicherung!
Die SQL Datei im Admin unter Service->Tools ausführen, anschliessend Views aktualisieren
tmp Ordner leeren
Modul aktivieren

Bei aktiviertem Modul wird ein den Zahlungsarten das neue Feld "bis Bonitätsindex" angezeigt.


