
```mermaid
graph LR
    fa:fa-check-->fa:fa-coffee
```

```mermaid

classDiagram

class Projet1 {
  + id: int
  + nom: string
  + description: string
  + dateDebut: date
}

```

::: mermaid

classDiagram

class Projet1 {
  + id: int
  + nom: string
  + description: string
  + dateDebut: date
}

class Projet2 {
  + id: int
  + nom: string
  + description: string
  + dateDebut: date
}

class Projet3 {
  + id: int
  + nom: string
  + description: string
  + dateDebut: date
}

class Tâche {
  + id: int
  + nom: string
  + description: string
  + priorité: int
  + état: string
}

class Utilisateur {
  + id: int
  + nom: string
  + prénom: string
  + email: string
  + motDePasse: string
}

Projet --* Tâche
Utilisateur --* Tâche

```
