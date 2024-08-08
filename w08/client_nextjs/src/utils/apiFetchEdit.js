export const facultyAPIShowId = async (id, setFacultyData, setFacultyShow, setFacultyId) => {
  const response = await fetch(`http://127.0.0.1:8000/api/faculty/${id}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });
  const data = await response.json();
  setFacultyData(data);
  setFacultyShow(true);
  setFacultyId(id);
};

export const facultyAPIEdit = async (facultyId, faculty_th, faculty_en, token) => {
  const response = await fetch(
    `http://127.0.0.1:8000/api/faculty/${facultyId}`,
    {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ faculty_th, faculty_en }),
    }
  );

  const data = await response.json();
  window.location.reload();
};

