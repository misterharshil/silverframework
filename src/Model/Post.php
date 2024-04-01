<?php

namespace silverorange\DevTest\Model;

class Post
{
    private $db;
    private $data;

    public function __construct(\PDO $db, array $data = [])
    {
        $this->db = $db;
        $this->data = $data;
    }

    // This method saves Post data into the database
    public function save($data): void
    {
        $sql = "INSERT INTO Posts (id, title, body, created_at, modified_at, author) 
                    VALUES (:id, :title, :body, :created_at, :modified_at, :author)";
        $this->db->prepare($sql)->execute($data);
    }

    // This method selects the post data from the database
    public function getPost($id): ?array
    {
        $sql = "SELECT p.id, p.title, p.body, a.full_name as author_name
                FROM Posts as p
                LEFT JOIN Authors as a ON p.author = a.id
                WHERE p.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $post = $stmt->fetch();

        if ($post === false) {
            return null; // Return null if post with given id is not found
        }

        return [
            'id' => $post['id'],
            'title' => $post['title'],
            'body' => $post['body'],
            'author' => $post['author_name'] // Assuming author name is retrieved from the Authors table
        ];
    }

    // This method selects all posts from the database
    public function getAllPost(): array
    {
        $sql = "SELECT p.id, p.title, p.created_at FROM Posts as p ORDER BY p.created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getTitle(): ?string
    {
        return $this->data['title'] ?? null;
    }

    public function getBody(): ?string
    {
        return $this->data['body'] ?? null;
    }

    public function getAuthor(): ?string
    {
        return $this->data['author'] ?? null;
    }
}
