<?php

use CardGame\Card;
use CardGame\Deck;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testFaceCard() {
        $faceCard = new Card('hearts', 11); // Jack of Hearts
        $nonFaceCard = new Card('clubs', 7); // 7 of Clubs

        $this->assertTrue($faceCard->faceCard(), 'Failed asserting that the card is a face card.');
        $this->assertFalse($nonFaceCard->faceCard(), 'Failed asserting that the card is not a face card.');
    }

    public function testToString() {
        $card = new Card('spades', 1); // Ace of Spades
        $expectedString = 'Ace of spades';
        $actualString = strval($card);

        $this->assertEquals($expectedString, $actualString, "Failed asserting that the card string representation is '$expectedString'.");
    }

    public function testComparable() {
        $card1 = new Card('hearts', 10); // 10 of Hearts
        $card2 = new Card('clubs', 5); // 5 of Clubs
        $card3 = new Card('diamonds', 10); // 10 of Diamonds

        $this->assertGreaterThan(0, $card1->compareTo($card2), 'Failed asserting that card1 is greater than card2.');
        $this->assertLessThan(0, $card2->compareTo($card1), 'Failed asserting that card2 is less than card1.');
        $this->assertEquals(0, $card1->compareTo($card3), 'Failed asserting that card1 is equal to card3.');
    }
}

class DeckTest extends TestCase {
    private $deck;

    public function __construct()
    {
        parent::__construct();

        $this->deck = new Deck();
    }

    public function testCount() {
        $expectedCount = 52;
        $actualCount = $this->deck->count();

        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that the deck count is $expectedCount.");

        $this->deck->draw(10);
        $expectedCount = 42;
        $actualCount = $this->deck->count();

        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that the deck count is $expectedCount after drawing 10 cards.");

        // Additional assertions
        $this->deck->draw(20);
        $expectedCount = 22;
        $actualCount = $this->deck->count();

        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that the deck count is $expectedCount after drawing 20 more cards.");

        $this->assertNotEquals(0, $actualCount, "The deck should not be empty.");
        $this->assertLessThanOrEqual($expectedCount, $actualCount, "The deck count should be less than or equal to $expectedCount.");
    }

    public function testShuffle() {
        $deck1 = new Deck();
        $deck2 = new Deck();

        $this->assertEquals($deck1->cards, $deck2->cards, 'Failed asserting that deck1 and deck2 have the same initial card order.');

        $deck1->shuffle();

        $this->assertNotEquals($deck1->cards, $deck2->cards, 'Failed asserting that deck1 and deck2 have different card order after shuffling.');

        // Additional assertions
        $deck3 = new Deck();
        $deck3->shuffle();
        $this->assertNotEquals($deck1->cards, $deck3->cards, 'Failed asserting that deck1 and deck3 have different card order after shuffling.');

        $this->assertContainsEquals($deck1->cards[0], $deck3->cards, 'Failed asserting that deck1 has at least one card that is present in deck3 after shuffling.');
        $this->assertContainsEquals($deck1->cards[25], $deck3->cards, 'Failed asserting that deck1 has at least one card that is present in deck3 after shuffling.');
        $this->assertContainsEquals($deck1->cards[51], $deck3->cards, 'Failed asserting that deck1 has at least one card that is present in deck3 after shuffling.');
    }
    
    public function testDraw() {
        $expectedCount = 5;
        $cards = $this->deck->draw($expectedCount);
        $actualCount = count($cards);
    
        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that $expectedCount cards are drawn from the deck.");
    
        $expectedCount = 47;
        $actualCount = $this->deck->count();
    
        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that the deck count is $expectedCount after drawing 5 cards.");
    
        $expectedCards = array_slice($this->deck->cards, -5, 5);
    
        $this->assertEquals($expectedCards, $cards, 'Failed asserting that the drawn cards match the expected cards.');
    
        // Additional assertions
        $cards = $this->deck->draw(10);
        $expectedCount = 37;
        $actualCount = $this->deck->count();
    
        $this->assertEquals($expectedCount, $actualCount, "Failed asserting that the deck count is $expectedCount after drawing 10 more cards.");
    
        $expectedCards = array_slice($this->deck->cards, -10, 10);
    
        $this->assertEquals($expectedCards, $cards, 'Failed asserting that the drawn cards match the expected cards.');
    
        $this->assertNotEquals(0, $actualCount, "The deck should not be empty.");
        $this->assertLessThanOrEqual($expectedCount, $actualCount, "The deck count should be less than or equal to $expectedCount.");
    }
}