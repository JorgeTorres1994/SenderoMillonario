import random
import string
import csv

# Función para generar un código alfanumérico de 8 dígitos
def generar_codigo(longitud=8):
    caracteres = string.ascii_uppercase + string.digits
    return ''.join(random.choice(caracteres) for _ in range(longitud))

# Generar 500 códigos únicos
codigos = [generar_codigo() for _ in range(500)]

# Escribir los códigos en un archivo CSV
with open('codigos.csv', 'w', newline='') as archivo_csv:
    writer = csv.writer(archivo_csv)
    writer.writerow(['Codigo'])  # Nombre de la columna
    for codigo in codigos:
        writer.writerow([codigo])

print("500 códigos generados y guardados en 'codigos.csv'")
