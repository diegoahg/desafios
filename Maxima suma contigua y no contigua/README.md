# Desafio de suma maxima en arreglo contiguo y no contiguo
Descripcion: SUMAS MAXIMAS DE ARREGLOS CONTIGUOS Y NO-CONTIGUOS


# Problema
Dado un arreglo A = {a1, a2, …, an} de N elementos, encontrar la suma máxima posible de:

1. Un subarreglo contiguo 
2. Un subarreglo no-contiguo (no necesariamente contiguo).

Un subarreglo es una subsecuencia contigua. Subarreglos/subsecuencias vacías no deberían ser consideradas/os.

Formato de entrada: 
· La primera línea de input contiene un entero T que indica la cantidad de casos de prueba. Luego siguen T casos de prueba. 
· Cada caso de prueba empieza con un entero N. En la siguiente línea, siguen N enteros que representan los elementos del arreglo A.

Restricciones: 
1 <= T <= 10
1 <= N <= 10^5
-10^4 <= ai <= 10^4

El subarreglo y subsecuencias que consideres deberían tener al menos un elemento.

Formato de salida:
Imprimir dos enteros separados por espacios denotando las sumas máximas de subarreglos y subsecuencias no vacíos/as, respectivamente.

Ejemplo de entrada: 
2
4
1 2 3 4
6
2 -1 2 3 4 -5

Ejemplo de salida:
10 10
10 11

Explicación:
En el primer caso: La suma máxima para ambos es simplemente la suma de todos los elementos ya que todos son positivos.

En el segundo caso: El subarreglo [2, -1, 2, 3, 4] es el subarreglo con la suma máxima, y [2, 2, 3, 4] es la subsecuencia con la suma máxima.

# Ejecucion
php desafio.php
