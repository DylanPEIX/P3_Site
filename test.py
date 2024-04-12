import pygame
import random

# Dimensions de la grille
LARGEUR = 500
HAUTEUR = 500
TAILLE_CASE = 20

# Couleurs
BLANC = (255, 255, 255)
ROUGE = (255, 0, 0)
VERT = (0, 255, 0)
NOIR = (0, 0, 0)

# Vitesse du serpent
VITESSE = 10

# Classe principale du jeu
class Jeu:
    def __init__(self):
        self.surface = pygame.display.set_mode((LARGEUR, HAUTEUR))
        pygame.display.set_caption("Snake")
        self.clock = pygame.time.Clock()
        self.serpent = Serpent(self)
        self.nourriture = Nourriture(self)

    def nouveau_jeu(self):
        self.serpent = Serpent(self)
        self.nourriture = Nourriture(self)

    def maj_etat(self):
        self.serpent.maj_etat()
        self.dessiner_objet()

    def dessiner_objet(self):
        self.surface.fill(NOIR)
        self.serpent.dessiner_objet()
        self.nourriture.dessiner_objet()
        pygame.display.update()

    def verifier_evenement(self):
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                return False
        self.serpent.deplacer()
        return True

    def lancement_jeu(self):
        jeu_en_cours = True
        while jeu_en_cours:
            jeu_en_cours = self.verifier_evenement()
            self.maj_etat()
            self.clock.tick(VITESSE)

    def dessiner_grille(self):
        for x in range(0, LARGEUR, TAILLE_CASE):
            pygame.draw.line(self.surface, BLANC, (x, 0), (x, HAUTEUR))
        for y in range(0, HAUTEUR, TAILLE_CASE):
            pygame.draw.line(self.surface, BLANC, (0, y), (LARGEUR, y))

# Classe représentant le serpent
class Serpent:
    def __init__(self, jeu):
        self.jeu = jeu
        self.segments = [(240, 200), (220, 200), (200, 200)]
        self.direction = "droite"

    def maj_etat(self):
        x, y = self.segments[0]
        if self.direction == "haut":
            y -= TAILLE_CASE
        elif self.direction == "bas":
            y += TAILLE_CASE
        elif self.direction == "gauche":
            x -= TAILLE_CASE
        elif self.direction == "droite":
            x += TAILLE_CASE

        if x < 0 or x >= LARGEUR or y < 0 or y >= HAUTEUR:
            self.jeu.nouveau_jeu()
            return

        if (x, y) in self.segments[1:]:
            self.jeu.nouveau_jeu()
            return

        self.segments.insert(0, (x, y))
        if self.segments[0] == self.jeu.nourriture.position:
            self.jeu.nourriture.changer_position()
        else:
            self.segments.pop()

    def dessiner_objet(self):
        for segment in self.segments:
            pygame.draw.rect(self.jeu.surface, VERT, (segment[0], segment[1], TAILLE_CASE, TAILLE_CASE))
    
    def deplacer(self):
        keys = pygame.key.get_pressed()
        if keys[pygame.K_LEFT] and self.direction != "droite":
            self.direction = "gauche"
        elif keys[pygame.K_RIGHT] and self.direction != "gauche":
            self.direction = "droite"
        elif keys[pygame.K_UP] and self.direction != "bas":
            self.direction = "haut"
        elif keys[pygame.K_DOWN] and self.direction != "haut":
            self.direction = "bas"

# Classe représentant la nourriture
class Nourriture:
    def __init__(self, jeu):
        self.jeu = jeu
        self.position = (random.randint(0, LARGEUR // TAILLE_CASE - 1) * TAILLE_CASE,
                         random.randint(0, HAUTEUR // TAILLE_CASE - 1) * TAILLE_CASE)

    def dessiner_objet(self):
        pygame.draw.rect(self.jeu.surface, ROUGE, (self.position[0], self.position[1], TAILLE_CASE, TAILLE_CASE))

    def changer_position(self):
        self.position = (random.randint(0, LARGEUR // TAILLE_CASE - 1) * TAILLE_CASE,
                         random.randint(0, HAUTEUR // TAILLE_CASE - 1) * TAILLE_CASE)

# Script principal
if __name__ == "__main__":
    pygame.init()
    jeu = Jeu()
    jeu.lancement_jeu()
    pygame.quit()
