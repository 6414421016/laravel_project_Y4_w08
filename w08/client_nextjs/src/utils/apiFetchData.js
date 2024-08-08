export const handleFaculty = async (setLoading, setFaculty) => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/faculty");
      const data = await response.json();
      setFaculty(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  
  export const handleProgram = async (setLoading, setProgram) => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/program");
      const data = await response.json();
      setProgram(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  
  export const handleStudent = async (setLoading, setStudent) => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/student");
      const data = await response.json();
      setStudent(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  
  export const handleVaccine = async (setLoading, setVaccine) => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/vaccine");
      const data = await response.json();
      setVaccine(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  