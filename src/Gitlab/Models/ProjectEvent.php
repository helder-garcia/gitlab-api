<?php
namespace Gitlab\Models;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

class ProjectEvent implements ResponseClassInterface
{

    protected $target_title;
    protected $project_id;
    protected $action_name;
    protected $target_id;
    protected $target_iid;
    protected $target_type;
    protected $author_id;
    protected $data;
    protected $target_url;
    protected $author;
    protected $created_at;
    protected $author_username;

    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse();
        $item = $response->json();

        return new self($item);
    }

    public function __construct(array $item)
    {
        foreach ($item as $name => $content) {
            $this->{$name} = $content;
        }
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->action_name;
    }

    /**
     * @param mixed $action_name
     */
    public function setActionName($action_name)
    {
        $this->action_name = $action_name;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param mixed $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @param mixed $project_id
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * @return mixed
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * @param mixed $target_id
     */
    public function setTargetId($target_id)
    {
        $this->target_id = $target_id;
    }

    /**
     * @return mixed
     */
    public function getTargetIid()
    {
        return $this->target_id;
    }

    /**
     * @param mixed $target_id
     */
    public function setTargetIid($target_id)
    {
        $this->target_id = $target_id;
    }

    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->target_type;
    }

    /**
     * @param mixed $target_type
     */
    public function setTargetType($target_type)
    {
        $this->target_type = $target_type;
    }

    /**
     * @return mixed
     */
    public function getTargetUrl()
    {
        return $this->target_url;
    }

    /**
     * @param mixed $target_url
     */
    public function setTargetUrl($target_url)
    {
        $this->target_url = $target_url;
    }

    /**
     * @return mixed
     */
    public function getTargetTitle()
    {
        return $this->target_title;
    }

    /**
     * @param mixed $target_title
     */
    public function setTargetTitle($target_title)
    {
        $this->target_title = $target_title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $target_title
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getAuthorUsername()
    {
        return $this->author_username;
    }

    /**
     * @param mixed $author_username
     */
    public function setAuthorUsername($author_username)
    {
        $this->created_at = $author_username;
    }

}
