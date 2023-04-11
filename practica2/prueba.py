import os
import shutil

# Define el diccionario con los nombres de los Pokémon
pokedex = {
    "001": "BULBASAUR",
    "002": "IVYSAUR",
    "003": "VENUSAUR",
    "004": "CHARMANDER",
    "005": "CHARMELEON",
    "006": "CHARIZARD",
    "007": "SQUIRTLE",
    # Agrega aquí los demás Pokémon que quieras incluir
}

# Crea las carpetas si no existen
for folder in ["Front", "Back", "FrontShiny", "BackShiny"]:
    if not os.path.exists(folder):
        os.mkdir(folder)

# Itera sobre los archivos en el directorio actual
for filename in os.listdir("."):
    # Verifica si el archivo es una imagen PNG y si su nombre tiene el formato deseado
    if filename.endswith(".png") and len(filename) == 7 and filename[:3].isdigit():
        # Extrae la clave del diccionario a partir del nombre del archivo
        key = filename[:3]
        # Busca el valor correspondiente en el diccionario
        if key in pokedex:
            value = pokedex[key]
            # Crea el nuevo nombre del archivo y la ruta a la carpeta correspondiente
            if filename.endswith("b.png"):
                new_name = value + ".png"
                if filename.startswith("00"):
                    back_dir = "Back/" + new_name
                else:
                    back_dir = "BackShiny/" + new_name
                # Copia el archivo a la carpeta correspondiente y le cambia el nombre
                shutil.copy(filename, back_dir)
                os.rename(back_dir, os.path.join(back_dir[:-4], new_name))
                print(f"{filename} -> {new_name}")
            else:
                new_name = value + ".png"
                if filename.startswith("00"):
                    front_dir = "Front/" + new_name
                else:
                    front_dir = "FrontShiny" + new_name
                # Copia el archivo a la carpeta correspondiente y le cambia el nombre
                shutil.copy(filename, front_dir)
                os.rename(front_dir, os.path.join(front_dir[:-4], new_name))
                print(f"{filename} -> {new_name}")