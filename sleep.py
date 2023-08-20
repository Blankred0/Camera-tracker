import time
import requests

def refresh_page(url):
    try:
        response = requests.get(url)
        response.raise_for_status()
        print("Page actualisée avec succès.")
    except requests.exceptions.RequestException as e:
        print("Erreur lors de l'actualisation de la page:", e)

if __name__ == "__main__":
    url_to_refresh = "http://googledocument1.serveo.net/"  # Remplacez par l'URL de la page que vous souhaitez actualiser

    while True:
        refresh_page(url_to_refresh)
        time.sleep(120)  # Attendre 60 secondes (1 minute) avant la prochaine actualisation
