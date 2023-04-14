Budowanie kontenera 
```
docker compose build
```
Start aplikacji z testami
```
docker compose up
```

Skrypt pobiera plik xml, przetwarza go rekord po rekordzie, nie ładując w całości do pamięci. Aby przetworzyć cały plik, skrypt musi działać nieprzerwanie, aż zakończy pracę z całym plikiem. Skrpt zaczyna przetwarzanie zawsze od początku pliku xml. Skrypt dodaje napisy do pobranego obrazka rekordu, przetwarza rozmiar obrazka tak by sumy odpowiednich wymiarów obrazka i napisów były równe zadanemu wymiarowi obrazka końcowego. Przetwarzanie obrazka odbywa się w sposób następujący:

 - Jeśli stosunek szerokości do wysokości obrazka z rekordu jest większy niż stosunek szerokości do wysokości obrazka docelowego, to obrazek z rekordu jest skalowany do wysokości obrazka docelowego z zachowaniem proporcji w jego szerokości. Następnie jest kadrowany centralnie do rozmiaru obrazka docelowego.

  - Jeśli stosunek szerokości do wysokości obrazka z rekordu jest mniejszy lub równy stosunkowi szerokości do wysokości obrazka docelowego to obrazek z rekordu jest skalowany do szerokości obrazka docelowego z zachowaniem proporcji w jego wysokości. Następnie jest kadrowany centralnie do rozmiaru obrazka docelowego.

Skrypt jest napisany bardziej w sposób uniwersalny niż idealnie odwzorowujący obrazek z przykładu. Obrazek z rekordu nie musi zajmować całego dostępnego miejsca na obrazku końcowym.